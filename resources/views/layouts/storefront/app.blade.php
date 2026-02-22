<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Loja' }} | E-commerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('storefront.home') }}" class="text-lg font-semibold tracking-tight">Minha Loja</a>
            <nav class="flex items-center gap-5 text-sm font-medium text-slate-600">
                <a href="{{ route('storefront.catalog') }}" class="transition hover:text-slate-900">Catalogo</a>
                <a href="{{ route('storefront.cart') }}" class="transition hover:text-slate-900">Carrinho</a>
                <a href="{{ route('storefront.checkout') }}" class="rounded-md bg-slate-900 px-3 py-2 text-white">Checkout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>
</html>
