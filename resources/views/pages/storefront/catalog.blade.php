@extends('layouts.storefront.app')

@section('content')
    <section>
        <h1 class="text-2xl font-bold">Catalogo</h1>
        <p class="mt-2 text-sm text-slate-600">Lista inicial de produtos para montar filtros, busca e ordenacao.</p>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <article class="rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-semibold">{{ $product['name'] }}</h2>
                <p class="mt-2 text-sm text-slate-600">{{ $product['description'] }}</p>
                <p class="mt-4 text-sm font-semibold">R$ {{ number_format($product['price'], 2, ',', '.') }}</p>
                <a href="{{ route('storefront.product.show', $product['slug']) }}"
                   class="mt-4 inline-flex rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:border-slate-900 hover:text-slate-900">
                    Detalhes
                </a>
            </article>
        @endforeach
    </section>
@endsection
