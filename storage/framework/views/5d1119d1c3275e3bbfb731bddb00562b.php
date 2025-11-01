<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Register - <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased bg-gradient-to-br from-primary-50 to-primary-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="/images/MBSTU_logo.png" alt="MBSTU Logo" class="h-16 w-16 object-contain">
                </div>
                <h1 class="text-3xl font-bold text-primary-600 mb-2">Central Alumni MBSTU</h1>
                <p class="text-gray-600">Mawlana Bhashani Science and Technology University</p>
                <p class="text-gray-500 text-sm mt-1">Create your alumni account to get started.</p>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="<?php echo e(old('name')); ?>" 
                            class="form-input" 
                            required 
                            autofocus
                        >
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?php echo e(old('email')); ?>" 
                            class="form-input" 
                            required
                        >
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input" 
                            required
                        >
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-input" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        Create Account
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="<?php echo e(route('login')); ?>" class="text-primary-600 hover:text-primary-800 font-medium">Sign in here</a>
                    </p>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-600 hover:text-gray-800 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-800">
                    <strong>Note:</strong> After registration, you'll be able to create your complete alumni profile 
                    with your education details, career information, and more.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/kawshik/Desktop/Project/Central Alumni MBSTU/resources/views/auth/register.blade.php ENDPATH**/ ?>