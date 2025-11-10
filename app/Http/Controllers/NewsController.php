<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $featuredNews = News::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $news = News::published()
            ->with(['department', 'author'])
            ->latest('published_at')
            ->paginate(12);

        return view('news.index', compact('featuredNews', 'news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published && !auth()->user()?->isSuperAdmin()) {
            abort(404);
        }

        $news->load(['department', 'author']);
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->where('department_id', $news->department_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        $departments = Department::all();
        return view('news.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', News::class);

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        // Make slug unique
        $originalSlug = $validated['slug'];
        $count = 1;
        while (News::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        }

        $news = News::create($validated);

        return redirect()->route('news.show', $news)
            ->with('success', 'News article created successfully.');
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        $departments = Department::all();
        return view('news.edit', compact('news', 'departments'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($validated['title'] !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            $originalSlug = $validated['slug'];
            $count = 1;
            while (News::where('slug', $validated['slug'])->where('id', '!=', $news->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        if (($validated['is_published'] ?? false) && !$news->published_at) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('news.show', $news)
            ->with('success', 'News article updated successfully.');
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'News article deleted successfully.');
    }
}
