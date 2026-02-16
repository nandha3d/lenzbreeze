<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lenz Breeze Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-warm-100 flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="card p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl gradient-brand flex items-center justify-center mx-auto">
                    <span class="text-white font-bold text-2xl font-display">LB</span>
                </div>
                <h1 class="font-display text-2xl font-bold text-brand-500 mt-4">Lenz Breeze Admin</h1>
                <p class="text-warm-400 text-sm mt-1">Sign in to manage your website</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-600 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" placeholder="admin@lenzbreeze.com" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary w-full !py-3.5">Sign In</button>
            </form>
        </div>
        <p class="text-center text-xs text-warm-400 mt-6">&copy; {{ date('Y') }} Lenz Breeze. All rights reserved.</p>
    </div>
</body>
</html>
