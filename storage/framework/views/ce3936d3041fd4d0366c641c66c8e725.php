<?php $__env->startSection('title', 'Departments'); ?>
<?php $__env->startSection('header', 'Departments'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">All Departments</h2>
        <?php if(auth()->check() && auth()->user()->isSuperAdmin()): ?>
            <a href="<?php echo e(route('departments.create')); ?>" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Department
            </a>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start space-x-4">
                    <?php if($department->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $department->logo)); ?>" alt="<?php echo e($department->name); ?>" class="w-16 h-16 rounded-lg object-cover">
                    <?php else: ?>
                        <div class="w-16 h-16 rounded-lg bg-primary-100 flex items-center justify-center">
                            <span class="text-2xl font-bold text-primary-600"><?php echo e(substr($department->code, 0, 2)); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900"><?php echo e($department->code); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo e($department->name); ?></p>
                    </div>
                </div>

                <?php if($department->description): ?>
                    <p class="mt-4 text-sm text-gray-700 line-clamp-3"><?php echo e($department->description); ?></p>
                <?php endif; ?>

                <div class="mt-4 flex items-center justify-between pt-4 border-t">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <?php echo e($department->alumni_profiles_count); ?> Alumni
                    </div>
                    <a href="<?php echo e(route('departments.show', $department)); ?>" class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                        View Details →
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p class="mt-4 text-gray-600">No departments found.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if($departments->hasPages()): ?>
        <div class="mt-6">
            <?php echo e($departments->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kawshik/Desktop/Project/Central Alumni MBSTU/resources/views/departments/index.blade.php ENDPATH**/ ?>