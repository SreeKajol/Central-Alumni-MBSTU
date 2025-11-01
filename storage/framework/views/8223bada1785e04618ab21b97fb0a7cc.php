<aside id="sidebar" class="sidebar expanded">
    <div class="h-full flex flex-col">
        <!-- Logo -->
        <div class="p-4 border-b border-primary-700">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center hover:opacity-80 transition">
                <div class="sidebar-icon flex-shrink-0">
                    <img src="/images/MBSTU_logo.png" alt="MBSTU Logo" class="w-6 h-6 object-contain">
                </div>
                <span class="sidebar-text text-lg font-bold">Central Alumni MBSTU</span>
            </a>
        </div>

        <!-- User Info Panel -->
        <?php if(auth()->guard()->check()): ?>
        <div class="p-4 border-b border-primary-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold text-lg">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </div>
                <div class="flex-1 min-w-0">
                    <p class="sidebar-text text-sm font-semibold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                    <p class="sidebar-text text-xs text-primary-200"><?php echo e(auth()->user()->role->label()); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <?php if(auth()->guard()->check()): ?>
            <!-- Main Section -->
            <div class="px-4 mb-2">
                <h3 class="sidebar-text text-xs font-semibold text-primary-300 uppercase tracking-wider">Main</h3>
            </div>
            
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <!-- Directory Section -->
            <div class="px-4 mt-6 mb-2">
                <h3 class="sidebar-text text-xs font-semibold text-primary-300 uppercase tracking-wider">Directory</h3>
            </div>

            <a href="<?php echo e(route('departments.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('departments.*') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="sidebar-text">Departments</span>
            </a>

            <a href="<?php echo e(route('alumni.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('alumni.*') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="sidebar-text">Alumni Directory</span>
            </a>

            <!-- Activities Section -->
            <div class="px-4 mt-6 mb-2">
                <h3 class="sidebar-text text-xs font-semibold text-primary-300 uppercase tracking-wider">Activities</h3>
            </div>

            <a href="<?php echo e(route('events.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('events.*') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="sidebar-text">Events & Reunions</span>
            </a>

            <a href="<?php echo e(route('news.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('news.*') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="sidebar-text">News & Notices</span>
            </a>

            <!-- My Account Section -->
            <div class="px-4 mt-6 mb-2">
                <h3 class="sidebar-text text-xs font-semibold text-primary-300 uppercase tracking-wider">My Account</h3>
            </div>

            <?php if(auth()->check() && auth()->user()->isAlumni() && !auth()->user()->alumniProfile): ?>
                <a href="<?php echo e(route('alumni.create')); ?>" class="sidebar-link bg-primary-700">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="sidebar-text">Create Alumni Profile</span>
                </a>
            <?php endif; ?>

            <?php if(auth()->check() && auth()->user()->alumniProfile): ?>
                <a href="<?php echo e(route('alumni.show', auth()->user()->alumniProfile)); ?>" class="sidebar-link <?php echo e(request()->routeIs('alumni.show') ? 'active' : ''); ?>">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="sidebar-text">My Profile</span>
                </a>
            <?php endif; ?>

            <a href="<?php echo e(route('profile.edit')); ?>" class="sidebar-link <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="sidebar-text">Account Settings</span>
            </a>

            <?php if(auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isDepartmentAdmin())): ?>
            <!-- Admin Section -->
            <div class="px-4 mt-6 mb-2">
                <h3 class="sidebar-text text-xs font-semibold text-yellow-300 uppercase tracking-wider">⚡ Administration</h3>
            </div>

            <a href="<?php echo e(route('departments.index')); ?>" class="sidebar-link">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <span class="sidebar-text">Manage Departments</span>
            </a>

            <a href="<?php echo e(route('events.index')); ?>" class="sidebar-link">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="sidebar-text">Manage Events</span>
            </a>

            <a href="<?php echo e(route('news.index')); ?>" class="sidebar-link">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="sidebar-text">Manage News</span>
            </a>
            <?php endif; ?>
            <?php endif; ?>
        </nav>

        <!-- Logout -->
        <?php if(auth()->guard()->check()): ?>
        <div class="border-t border-primary-700 p-4">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="sidebar-link w-full">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</aside>
<?php /**PATH /home/kawshik/Desktop/Project/Central Alumni MBSTU/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>