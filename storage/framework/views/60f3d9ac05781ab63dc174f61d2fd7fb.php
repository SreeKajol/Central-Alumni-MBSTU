<?php $__env->startSection('title', 'Events'); ?>
<?php $__env->startSection('header', 'Events & Reunions'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">University Events</h2>
        <?php if(auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isDepartmentAdmin())): ?>
            <a href="<?php echo e(route('events.create')); ?>" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Event
            </a>
        <?php endif; ?>
    </div>

    <!-- Upcoming Events -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="event-card">
                    <?php if($event->image): ?>
                        <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-2">
                            <?php if($event->department): ?>
                                <span class="badge badge-primary"><?php echo e($event->department->code); ?></span>
                            <?php else: ?>
                                <span class="badge badge-success">University-wide</span>
                            <?php endif; ?>
                            <?php if($event->event_type): ?>
                                <span class="badge badge-secondary"><?php echo e(ucfirst($event->event_type)); ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php echo e($event->title); ?></h3>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <?php echo e($event->event_date->format('F d, Y')); ?>

                            </div>
                            <?php if($event->location): ?>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    <?php echo e($event->location); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('events.show', $event)); ?>" class="btn btn-primary w-full">View Details</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12 card">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-600">No upcoming events.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if($upcomingEvents->hasPages()): ?>
            <div class="mt-6"><?php echo e($upcomingEvents->links()); ?></div>
        <?php endif; ?>
    </div>

    <!-- Past Events -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Past Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $pastEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="event-card opacity-75">
                    <?php if($event->image): ?>
                        <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" class="w-full h-48 object-cover grayscale">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php echo e($event->title); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo e($event->event_date->format('F d, Y')); ?></p>
                        <a href="<?php echo e(route('events.show', $event)); ?>" class="text-primary-600 hover:text-primary-800 text-sm font-medium mt-3 inline-block">View Details →</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-gray-500 text-center py-8">No past events.</p>
            <?php endif; ?>
        </div>

        <?php if($pastEvents->hasPages()): ?>
            <div class="mt-6"><?php echo e($pastEvents->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kawshik/Desktop/Project/Central Alumni MBSTU/resources/views/events/index.blade.php ENDPATH**/ ?>