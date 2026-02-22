<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class StorefrontController extends Controller
{
    public function home(): View
    {
        return view('pages.storefront.home', [
            'title' => 'Loja',
            'featuredProducts' => $this->products()->take(4),
        ]);
    }

    public function catalog(): View
    {
        return view('pages.storefront.catalog', [
            'title' => 'Catálogo',
            'products' => $this->products(),
        ]);
    }

    public function product(string $slug): View
    {
        $product = $this->products()->firstWhere('slug', $slug);

        abort_if(!$product, 404);

        return view('pages.storefront.product', [
            'title' => $product['name'],
            'product' => $product,
        ]);
    }

    public function cart(): View
    {
        return view('pages.storefront.cart', [
            'title' => 'Carrinho',
            'items' => $this->products()->take(2),
        ]);
    }

    public function checkout(): View
    {
        return view('pages.storefront.checkout', [
            'title' => 'Checkout',
        ]);
    }

    private function products(): Collection
    {
        return collect([
            [
                'slug' => 'camiseta-basic-premium',
                'name' => 'Camiseta Basic Premium',
                'price' => 89.90,
                'description' => 'Algodao penteado, modelagem regular e toque macio para uso diario.',
            ],
            [
                'slug' => 'mochila-urban-24l',
                'name' => 'Mochila Urban 24L',
                'price' => 219.90,
                'description' => 'Compartimentos internos para notebook, cabos e itens pessoais.',
            ],
            [
                'slug' => 'tenis-runner-flow',
                'name' => 'Tenis Runner Flow',
                'price' => 329.90,
                'description' => 'Amortecimento leve para corridas curtas e caminhadas urbanas.',
            ],
            [
                'slug' => 'fones-wave-pro',
                'name' => 'Fones Wave Pro',
                'price' => 459.90,
                'description' => 'Audio sem fio com cancelamento de ruido e microfone integrado.',
            ],
            [
                'slug' => 'garrafa-termica-750ml',
                'name' => 'Garrafa Termica 750ml',
                'price' => 79.90,
                'description' => 'Parede dupla em inox para manter temperatura por mais tempo.',
            ],
            [
                'slug' => 'jaqueta-windshield',
                'name' => 'Jaqueta Windshield',
                'price' => 279.90,
                'description' => 'Tecido resistente ao vento com forro interno respiravel.',
            ],
        ]);
    }
}
