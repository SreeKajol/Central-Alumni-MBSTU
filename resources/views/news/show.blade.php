@extends('layouts.app')

@section('title', $news->title)
@section('header', 'News Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="card">
        @if($news->image)
            <img src="{{ $news->imageUrl }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-t-lg">
        @endif

        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center space-x-2 mb-3">
                        @if($news->is_featured)
                            <span class="badge badge-warning">⭐ Featured</span>
                        @endif
                        @if($news->department)
                            <span class="badge badge-primary">{{ $news->department->name }}</span>
                        @else
                            <span class="badge badge-success">University-wide</span>
                        @endif
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900">{{ $news->title }}</h1>
                </div>

                @can('update', $news)
                    <a href="{{ route('news.edit', $news) }}" class="btn btn-secondary">Edit</a>
                @endcan
            </div>

            <div class="flex items-center space-x-4 pb-6 mb-6 border-b">
                <div class="flex items-center text-gray-600">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-3">
                        <span class="text-sm font-semibold text-primary-600">{{ substr($news->author->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $news->author->name }}</p>
                        <p class="text-sm text-gray-500">{{ $news->author->role->label() }}</p>
                    </div>
                </div>
                <div class="text-gray-500 text-sm">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $news->published_at->format('F d, Y') }}
                </div>
            </div>

            @if($news->excerpt)
                <div class="bg-gray-50 border-l-4 border-primary-500 p-4 mb-6">
                    <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                </div>
            @endif

            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>

            @if($news->department)
                <div class="mt-8 pt-6 border-t">
                    <a href="{{ route('departments.show', $news->department) }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        View more from {{ $news->department->name }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Related News -->
    @if($relatedNews->count() > 0)
        <div class="card">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedNews as $related)
                    <a href="{{ route('news.show', $related) }}" class="group">
                        @if($related->image)
                            <img src="{{ $related->imageUrl }}" alt="{{ $related->title }}" class="w-full h-32 object-cover rounded-lg mb-3">
                        @else
                            <div class="w-full h-32 bg-gradient-to-br from-gray-200 to-gray-400 rounded-lg mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                        <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 line-clamp-2">{{ $related->title }}</h4>
                        <p class="text-xs text-gray-500 mt-1">{{ $related->published_at->format('M d, Y') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex justify-between">
        <a href="{{ route('news.index') }}" class="btn btn-secondary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to News
        </a>

        @can('delete', $news)
            <form method="POST" action="{{ route('news.destroy', $news) }}" onsubmit="return confirm('Are you sure you want to delete this article?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Article</button>
            </form>
        @endcan
    </div>
</div>
@endsection
