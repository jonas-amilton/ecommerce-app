@extends('layouts.storefront.app')

@section('content')
    <section class="rounded-2xl bg-slate-900 px-6 py-10 text-white sm:px-10">
        <p class="text-sm font-semibold uppercase tracking-wide text-slate-300">Colecao da semana</p>
        <h1 class="mt-2 text-3xl font-bold sm:text-4xl">Frontend da loja</h1>
        <p class="mt-4 max-w-2xl text-slate-200">
            Esta area foi criada para a jornada de compra: vitrine, produto, carrinho e checkout.
        </p>
        <a href="{{ route('storefront.catalog') }}"
           class="mt-6 inline-flex rounded-lg bg-white px-5 py-3 text-sm font-semibold text-slate-900">
            Ver catalogo
        </a>
    </section>

    <section class="mt-10">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Produtos em destaque</h2>
            <a href="{{ route('storefront.catalog') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Ver todos</a>
        </div>

        <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featuredProducts as $product)
                <article class="rounded-xl border border-slate-200 bg-white p-4">
                    <h3 class="font-semibold">{{ $product['name'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $product['description'] }}</p>
                    <p class="mt-3 text-sm font-semibold">R$ {{ number_format($product['price'], 2, ',', '.') }}</p>
                    <a href="{{ route('storefront.product.show', $product['slug']) }}"
                       class="mt-3 inline-block text-sm font-medium text-slate-900 underline">
                        Ver produto
                    </a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
