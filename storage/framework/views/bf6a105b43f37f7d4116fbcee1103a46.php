<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Central Alumni MBSTU')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-primary-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg sticky top-0 z-50 border-b border-primary-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo Section -->
                    <div class="flex items-center space-x-4">
                        <a href="<?php echo e(url('/')); ?>" class="flex items-center space-x-3 group">
                            <div class="relative">
                                <div class="absolute inset-0 bg-primary-400 rounded-full blur opacity-20 group-hover:opacity-30 transition"></div>
                                <img src="/images/MBSTU_logo.png" alt="MBSTU Logo" class="relative h-12 w-12 object-contain transition-transform group-hover:scale-110 duration-300">
                            </div>
                            <div>
                                <span class="text-xl font-bold text-primary-600 block leading-tight">Central Alumni</span>
                                <span class="text-base text-gray-600 font-medium">MBSTU</span>
                            </div>
                        </a>
                    </div>

                    <!-- Navigation Links - Desktop -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="<?php echo e(route('alumni.index')); ?>" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition font-medium">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Alumni
                        </a>
                        <a href="<?php echo e(route('departments.index')); ?>" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition font-medium">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Departments
                        </a>
                        <a href="<?php echo e(route('events.index')); ?>" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition font-medium">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Events
                        </a>
                        <a href="<?php echo e(route('news.index')); ?>" class="nav-link px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition font-medium">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            News
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-3">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-black rounded-lg font-bold hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl ring-2 ring-primary-200 hover:ring-primary-300">
                                <svg class="w-5 h-5 mr-2 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="px-4 py-2.5 text-gray-700 hover:text-primary-600 font-semibold transition">
                                Login
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-semibold hover:from-primary-700 hover:to-primary-800 transition shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Join Now
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h2 class="text-5xl font-bold text-gray-900 mb-6">
                    Connect with MBSTU Alumni Network
                </h2>
                <p class="text-xl text-gray-700 mb-8 max-w-3xl mx-auto">
                    Welcome to the Central Alumni System of Mawlana Bhashani Science and Technology University. Stay connected with fellow alumni, discover upcoming events, and maintain strong ties with your department and university.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="<?php echo e(route('alumni.index')); ?>" class="btn btn-primary px-8 py-3 text-lg">
                        Browse Alumni Directory
                    </a>
                    <a href="<?php echo e(route('departments.index')); ?>" class="btn btn-secondary px-8 py-3 text-lg">
                        Explore Departments
                    </a>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Alumni Directory</h3>
                    <p class="text-gray-600">Search and connect with alumni from all departments and batches.</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Events & Reunions</h3>
                    <p class="text-gray-600">Stay updated on upcoming events, reunions, and networking opportunities.</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Department Pages</h3>
                    <p class="text-gray-600">Each department has dedicated pages with alumni, news, and events.</p>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Quick Access</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="<?php echo e(route('departments.index')); ?>" class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-center">
                        <div class="text-2xl mb-2">🏛️</div>
                        <div class="font-medium text-gray-900">Departments</div>
                    </a>
                    <a href="<?php echo e(route('alumni.index')); ?>" class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-center">
                        <div class="text-2xl mb-2">👥</div>
                        <div class="font-medium text-gray-900">Alumni</div>
                    </a>
                    <a href="<?php echo e(route('events.index')); ?>" class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-center">
                        <div class="text-2xl mb-2">📅</div>
                        <div class="font-medium text-gray-900">Events</div>
                    </a>
                    <a href="<?php echo e(route('news.index')); ?>" class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-center">
                        <div class="text-2xl mb-2">📰</div>
                        <div class="font-medium text-gray-900">News</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- ===================================== -->
        <!-- NEW SECTIONS START HERE -->
        <!-- ===================================== -->

        <!-- About Section -->
        <section class="bg-primary-50 py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Side - Text Content -->
                    <div class="space-y-6 p-6 lg:p-8">

                        <!-- Heading -->
                        <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                            About Our
                            <span class="text-primary-600">Alumni</span>
                        </h2>

                        <!-- Description -->
                        <div class="space-y-4">
                            <p class="text-lg text-gray-700 leading-relaxed text-justify">
                                Mawlana Bhashani Science and Technology University (MBSTU) has been a cornerstone of excellence in science, technology, and innovation since its establishment. Our alumni community represents thousands of successful professionals, researchers, entrepreneurs, and leaders who have made significant contributions across various fields globally.
                            </p>
                         
                        </div>

                        <!-- Feature Points -->
                        <div class="space-y-3 pt-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-justify">Connect with alumni from all departments and batches worldwide</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-justify">Access mentorship programs, job opportunities, and career resources</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-justify">Participate in events, reunions, and contribute to MBSTU's development</p>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-4">
                            <a href="<?php echo e(route('alumni.archive')); ?>" class="inline-flex items-center bg-primary-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-700 transition shadow-lg hover:shadow-xl">
                                Alumni Archive
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right Side - Alumni Photos -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <a href="<?php echo e(route('alumni.archive')); ?>" class="block group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition">
                                <img src="/images/alumni1.jpg" alt="Alumni" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            </a>
                            <a href="<?php echo e(route('alumni.archive')); ?>" class="block group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition">
                                <img src="/images/alumni2.jpg" alt="Alumni" class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                            </a>
                        </div>
                        <div class="space-y-4 mt-8">
                            <a href="<?php echo e(route('alumni.archive')); ?>" class="block group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition">
                                <img src="/images/alumni3.jpg" alt="Alumni" class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                            </a>
                            <a href="<?php echo e(route('alumni.archive')); ?>" class="block group overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition">
                                <img src="/images/alumni4.jpg" alt="Alumni" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievements Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Impact & Achievements</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                        <h3 class="text-4xl font-bold text-primary-600 mb-2">10,000+</h3>
                        <p class="text-gray-600">Registered Alumni Worldwide</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                        <h3 class="text-4xl font-bold text-green-600 mb-2">100+</h3>
                        <p class="text-gray-600">Departments & Programs Connected</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-lg shadow-sm">
                        <h3 class="text-4xl font-bold text-purple-600 mb-2">50+</h3>
                        <p class="text-gray-600">Annual Events & Reunions Organized</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Alumni -->
        <section class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Featured Alumni</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Alumni Profile 1 -->
<<<<<<< HEAD
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300 cursor-pointer">
                        <a href="<?php echo e(route('alumni.index')); ?>" class="block group">
=======
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300">
                        <a href="<?php echo e(route('alumni.archive')); ?>" class="block group">
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                            <div class="relative inline-block mb-4">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                                <img src="/images/profile-alumni1.jpg" alt="Dr. Nazmul Hasan" class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg ring-4 ring-primary-100 group-hover:ring-primary-200 transition duration-300">
                            </div>
<<<<<<< HEAD
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-primary-600 transition">Dr. Nazmul Hasan</h3>
                            <p class="text-sm text-primary-600 font-medium mb-1">PhD, Oxford University</p>
                            <p class="text-xs text-gray-500 mb-3">CSE Batch 2005</p>
                            <p class="mt-3 text-gray-600 text-sm italic">"The MBSTU Alumni Network helped me reconnect with my mentors and collaborate on global research projects."</p>
                        </a>
                    </div>

                    <!-- Alumni Profile 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300 cursor-pointer">
                        <a href="<?php echo e(route('alumni.index')); ?>" class="block group">
=======
                        </a>
                        <h3 class="text-xl font-semibold text-gray-900">Dr. Nazmul Hasan</h3>
                        <p class="text-sm text-primary-600 font-medium mb-1">PhD, Oxford University</p>
                        <p class="text-xs text-gray-500 mb-3">CSE Batch 2005</p>
                        <p class="mt-3 text-gray-600 text-sm italic">"The MBSTU Alumni Network helped me reconnect with my mentors and collaborate on global research projects."</p>
                    </div>

                    <!-- Alumni Profile 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300">
                        <a href="<?php echo e(route('alumni.archive')); ?>" class="block group">
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                            <div class="relative inline-block mb-4">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                                <img src="/images/profile-alumni2.jpg" alt="Engr. Afsana Rahman" class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg ring-4 ring-primary-100 group-hover:ring-primary-200 transition duration-300">
                            </div>
<<<<<<< HEAD
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-primary-600 transition">Engr. Afsana Rahman</h3>
                            <p class="text-sm text-primary-600 font-medium mb-1">Software Engineer, Google</p>
                            <p class="text-xs text-gray-500 mb-3">EEE Batch 2010</p>
                            <p class="mt-3 text-gray-600 text-sm italic">"This platform bridges generations of MBSTU alumni and opens doors for professional collaboration."</p>
                        </a>
                    </div>

                    <!-- Alumni Profile 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300 cursor-pointer">
                        <a href="<?php echo e(route('alumni.index')); ?>" class="block group">
=======
                        </a>
                        <h3 class="text-xl font-semibold text-gray-900">Engr. Afsana Rahman</h3>
                        <p class="text-sm text-primary-600 font-medium mb-1">Software Engineer, Google</p>
                        <p class="text-xs text-gray-500 mb-3">EEE Batch 2010</p>
                        <p class="mt-3 text-gray-600 text-sm italic">"This platform bridges generations of MBSTU alumni and opens doors for professional collaboration."</p>
                    </div>

                    <!-- Alumni Profile 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300">
                        <a href="<?php echo e(route('alumni.archive')); ?>" class="block group">
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                            <div class="relative inline-block mb-4">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                                <img src="/images/profile-alumni3.jpg" alt="Md. Saif Hossain" class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg ring-4 ring-primary-100 group-hover:ring-primary-200 transition duration-300">
                            </div>
<<<<<<< HEAD
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-primary-600 transition">Md. Saif Hossain</h3>
                            <p class="text-sm text-primary-600 font-medium mb-1">Entrepreneur & CEO</p>
                            <p class="text-xs text-gray-500 mb-3">BBA Batch 2012</p>
                            <p class="mt-3 text-gray-600 text-sm italic">"A powerful community that continues to inspire innovation and leadership among MBSTU graduates."</p>
                        </a>
                    </div>
                </div>
                
                <!-- View All Alumni Button -->
                <div class="text-center mt-12">
                    <a href="<?php echo e(route('alumni.index')); ?>" class="inline-flex items-center px-8 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        View All Alumni
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
=======
                        </a>
                        <h3 class="text-xl font-semibold text-gray-900">Md. Saif Hossain</h3>
                        <p class="text-sm text-primary-600 font-medium mb-1">Entrepreneur & CEO</p>
                        <p class="text-xs text-gray-500 mb-3">BBA Batch 2012</p>
                        <p class="mt-3 text-gray-600 text-sm italic">"A powerful community that continues to inspire innovation and leadership among MBSTU graduates."</p>
                    </div>
                </div>
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
            </div>
        </section>

        <!-- News Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Latest News & Updates</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- News Card 1 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition">
                        <a href="<?php echo e(route('news.index')); ?>" class="block">
                            <img src="/images/news1.jpg" alt="News Image" class="w-full h-40 object-cover">
                        </a>
                        <div class="p-4">
                            <span class="text-xs text-primary-600 font-semibold">EVENTS</span>
                            <h3 class="font-semibold text-lg mb-2 mt-1">Annual Alumni Reunion 2025 Announced</h3>
                            <p class="text-gray-600 text-sm mb-4">Join us this December to celebrate our shared journey and achievements.</p>
                            
                            <!-- Author Info -->
                            <div class="flex items-center pt-3 border-t border-gray-200">
                                <img src="/images/author1.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Dr. Rahman Ahmed</p>
                                    <p class="text-xs text-gray-500">Alumni Affairs Office</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition">
                        <a href="<?php echo e(route('news.index')); ?>" class="block">
                            <img src="/images/news2.jpg" alt="News Image" class="w-full h-40 object-cover">
                        </a>
                        <div class="p-4">
                            <span class="text-xs text-green-600 font-semibold">CONTRIBUTION</span>
                            <h3 class="font-semibold text-lg mb-2 mt-1">MBSTU Alumni Contribute to Research Fund</h3>
                            <p class="text-gray-600 text-sm mb-4">A group of alumni recently funded new research facilities at MBSTU.</p>
                            
                            <!-- Author Info -->
                            <div class="flex items-center pt-3 border-t border-gray-200">
                                <img src="/images/author2.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                                <div>
<<<<<<< HEAD
                                    <p class="text-sm font-semibold text-gray-900">Professor Dr. Motiur Rahman</p>
=======
                                    <p class="text-sm font-semibold text-gray-900">Prof. Fatema Begum</p>
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                                    <p class="text-xs text-gray-500">Research Coordinator</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition">
                        <a href="<?php echo e(route('news.index')); ?>" class="block">
                            <img src="/images/news3.jpg" alt="News Image" class="w-full h-40 object-cover">
                        </a>
                        <div class="p-4">
                            <span class="text-xs text-purple-600 font-semibold">MENTORSHIP</span>
                            <h3 class="font-semibold text-lg mb-2 mt-1">Career Mentorship Program Launched</h3>
                            <p class="text-gray-600 text-sm mb-4">Senior alumni are mentoring recent graduates in tech, business, and academia.</p>
                            
                            <!-- Author Info -->
                            <div class="flex items-center pt-3 border-t border-gray-200">
                                <img src="/images/author3.jpg" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                                <div>
<<<<<<< HEAD
                                    <p class="text-sm font-semibold text-gray-900">Professor Dr. Md. Anwarul Azim Akhand</p>
=======
                                    <p class="text-sm font-semibold text-gray-900">Engr. Kamal Hossain</p>
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
                                    <p class="text-xs text-gray-500">Career Development Lead</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="bg-primary-600 text-white py-16">
            <div class="max-w-5xl mx-auto text-center px-4">
                <h2 class="text-3xl font-bold mb-4">Get Involved</h2>
                <p class="text-lg mb-6">
                    Want to contribute, mentor, or organize events? Reach out to the Alumni Affairs team and make a difference.
                </p>
                <a href="mailto:alumni@mbstu.ac.bd" class="bg-white text-primary-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                    Contact Us
                </a>
                <a href="<?php echo e(route('register')); ?>" class="bg-white text-primary-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block ml-4">
                    Join the Network
                </a>
            </div>
        </section>

        <!-- Partners Section -->
        <section class="bg-gray-50 py-12">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Supported By</h2>
                <p class="text-gray-600 mb-6 text-sm">In collaboration with leading organizations for educational excellence</p>
                <div class="flex justify-center items-center gap-8 flex-wrap">
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="/images/MBSTU_logo.png" alt="MBSTU" class="h-12 w-12 object-contain mx-auto">
                        <p class="text-xs text-gray-600 mt-2 font-medium">MBSTU</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="/images/UGC_Logo.png" alt="University Grants Commission" class="h-12 w-auto object-contain mx-auto">
                        <p class="text-xs text-gray-600 mt-2 font-medium">UGC Bangladesh</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="/images/IctDivisonLogo.jpeg" alt="ICT Division" class="h-12 w-auto object-contain mx-auto">
                        <p class="text-xs text-gray-600 mt-2 font-medium">ICT Division</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white mt-16 py-8 border-t">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="/images/MBSTU_logo.png" alt="MBSTU Logo" class="h-12 w-12 object-contain">
                        <div class="text-center">
                            <p class="font-semibold text-gray-900">Central Alumni MBSTU</p>
                            <p class="text-sm text-gray-600">Mawlana Bhashani Science and Technology University</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">&copy; <?php echo e(date('Y')); ?> Central Alumni MBSTU. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
<?php /**PATH /home/kawshik/Desktop/Project/Central Alumni MBSTU/resources/views/welcome.blade.php ENDPATH**/ ?>