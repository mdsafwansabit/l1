<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ultra Shop BD') }}</title>
    <script>
        // Use class strategy for dark mode with CDN Tailwind
        tailwind.config = { darkMode: 'class' }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Set initial theme before page paints to avoid flash
        (function(){
            try {
                var theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch(e){}
        })();
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        /* small helper for smooth image hover */
        .card-image { transition: transform .35s ease; }
        .card:hover .card-image { transform: scale(1.05); }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <header class="bg-white dark:bg-gray-900 shadow transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ config('app.name','Ultra Shop BD') }}</a>
            <nav class="space-x-4">
                <a href="{{ route('products.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">Products</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white inline-flex items-center gap-2">
                    <!-- Cart icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 6h13" />
                    </svg>
                    <span>Cart</span>
                    @php $cart = session('cart', []); $count = array_sum($cart); @endphp
                    <span class="ml-1 inline-flex items-center justify-center bg-red-500 text-white text-xs font-semibold rounded-full h-5 w-5">{{ $count }}</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">Admin</a>
                <!-- Dark mode toggle -->
                <button aria-label="Toggle dark mode" onclick="(function(){var h=document.documentElement; if(h.classList.toggle('dark')) localStorage.theme='dark'; else localStorage.theme='light';})()" class="ml-3 inline-flex items-center justify-center h-9 w-9 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:scale-105 transform transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 4.22a1 1 0 011.42 0L6.64 5.22a1 1 0 11-1.42 1.42L4.22 5.64a1 1 0 010-1.42zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zM4.22 15.78a1 1 0 010-1.42L5.22 13.36a1 1 0 111.42 1.42l-1 1a1 1 0 01-1.42 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM15.78 15.78a1 1 0 011.42 0l1 1a1 1 0 01-1.42 1.42l-1-1a1 1 0 010-1.42zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.78 4.22a1 1 0 010 1.42l-1 1a1 1 0 11-1.42-1.42l1-1a1 1 0 011.42 0z" /></svg>
                </button>
            </nav>
        </div>
    </header>

    <main class="py-8">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false,3000)" class="max-w-6xl mx-auto px-4 mb-4">
                <div class="inline-flex items-center gap-2 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-200 px-4 py-2 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=>show=false,4000)" class="max-w-6xl mx-auto px-4 mb-4">
                <div class="inline-flex items-center gap-2 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-200 px-4 py-2 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 002 0zm-1 4a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
