@extends('layouts.storefront.app')

@section('content')
    <section class="grid gap-8 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-8">
            <div class="flex h-72 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                Imagem do produto
            </div>
        </div>
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Produto</p>
            <h1 class="mt-2 text-3xl font-bold">{{ $product['name'] }}</h1>
            <p class="mt-4 text-slate-600">{{ $product['description'] }}</p>
            <p class="mt-6 text-2xl font-semibold">R$ {{ number_format($product['price'], 2, ',', '.') }}</p>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('storefront.cart') }}"
                   class="inline-flex rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">
                    Adicionar ao carrinho
                </a>
                <a href="{{ route('storefront.catalog') }}"
                   class="inline-flex rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">
                    Voltar ao catalogo
                </a>
            </div>
        </div>
    </section>
@endsection
