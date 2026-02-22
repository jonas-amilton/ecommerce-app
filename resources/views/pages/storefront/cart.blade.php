@extends('layouts.storefront.app')

@section('content')
    <section>
        <h1 class="text-2xl font-bold">Carrinho</h1>
        <p class="mt-2 text-sm text-slate-600">Estrutura pronta para conectar sessao, cupons e frete.</p>
    </section>

    <section class="mt-6 space-y-3">
        @foreach ($items as $item)
            <article class="rounded-xl border border-slate-200 bg-white p-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="font-semibold">{{ $item['name'] }}</h2>
                        <p class="text-sm text-slate-500">Quantidade: 1</p>
                    </div>
                    <p class="font-semibold">R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="mt-6 rounded-xl border border-slate-200 bg-white p-4">
        <div class="flex items-center justify-between text-sm">
            <span class="text-slate-600">Subtotal</span>
            <span class="font-semibold">
                R$ {{ number_format($items->sum('price'), 2, ',', '.') }}
            </span>
        </div>
        <a href="{{ route('storefront.checkout') }}"
           class="mt-4 inline-flex rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">
            Ir para checkout
        </a>
    </section>
@endsection
