@include('pages.auth.signin', [
    'title' => $title ?? 'Seller Sign In',
    'guard' => 'seller',
    'loginRoute' => 'seller.login.submit',
])
