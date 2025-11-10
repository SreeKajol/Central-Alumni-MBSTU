<?php $__env->startSection('title', 'News & Announcements'); ?>
<?php $__env->startSection('header', 'News & Announcements'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Latest News</h2>
        <?php if(auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isDepartmentAdmin())): ?>
            <a href="<?php echo e(route('news.create')); ?>" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create News
            </a>
        <?php endif; ?>
    </div>

    <!-- Featured News -->
    <?php if($featuredNews->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $featuredNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="news-card">
                    <?php if($featured->image): ?>
                        <img src="<?php echo e($featured->imageUrl); ?>" alt="<?php echo e($featured->title); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="badge badge-warning">⭐ Featured</span>
                            <?php if($featured->department): ?>
                                <span class="badge badge-primary"><?php echo e($featured->department->code); ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2"><?php echo e($featured->title); ?></h3>
                        
                        <?php if($featured->excerpt): ?>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3"><?php echo e($featured->excerpt); ?></p>
                        <?php endif; ?>

                        <div class="flex items-center justify-between pt-4 border-t">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <?php echo e($featured->author->name); ?>

                            </div>
                            <span class="text-xs text-gray-500"><?php echo e($featured->published_at->diffForHumans()); ?></span>
                        </div>

                        <a href="<?php echo e(route('news.show', $featured)); ?>" class="btn btn-primary w-full mt-4">Read More</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <!-- All News -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">All Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="news-card">
                    <?php if($article->image): ?>
                        <img src="<?php echo e($article->imageUrl); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-400 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <?php if($article->department): ?>
                            <span class="badge badge-primary mb-2"><?php echo e($article->department->code); ?></span>
                        <?php else: ?>
                            <span class="badge badge-success mb-2">University-wide</span>
                        <?php endif; ?>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2"><?php echo e($article->title); ?></h3>
                        
                        <?php if($article->excerpt): ?>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo e($article->excerpt); ?></p>
                        <?php endif; ?>

                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <span><?php echo e($article->author->name); ?></span>
                            <span><?php echo e($article->published_at->format('M d, Y')); ?></span>
                        </div>

                        <a href="<?php echo e(route('news.show', $article)); ?>" class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                            Read More →
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12 card">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <p class="mt-4 text-gray-600">No news articles available.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if($news->hasPages()): ?>
            <div class="mt-6"><?php echo e($news->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kawshik/Desktop/Project/alumni-system/resources/views/news/index.blade.php ENDPATH**/ ?>