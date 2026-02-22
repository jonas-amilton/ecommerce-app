@extends('layouts.storefront.app')

@section('content')
    <section>
        <h1 class="text-2xl font-bold">Checkout</h1>
        <p class="mt-2 text-sm text-slate-600">Formulario base para dados de entrega e pagamento.</p>
    </section>

    <section class="mt-6 grid gap-6 lg:grid-cols-2">
        <form class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Nome completo</label>
                <input type="text" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm" placeholder="Seu nome" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input type="email" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm" placeholder="voce@email.com" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Endereco</label>
                <input type="text" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm" placeholder="Rua, numero, bairro" />
            </div>
            <button type="button" class="rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white">
                Finalizar pedido
            </button>
        </form>

        <aside class="rounded-xl border border-slate-200 bg-white p-5">
            <h2 class="text-lg font-semibold">Resumo</h2>
            <p class="mt-3 text-sm text-slate-600">Conecte aqui os itens do carrinho e o calculo de frete/cupom.</p>
        </aside>
    </section>
@endsection
