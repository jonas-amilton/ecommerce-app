@include('pages.auth.signup', [
    'title'          => $title ?? 'Seller Sign Up',
    'guard'          => 'seller',
    'registerRoute'  => 'seller.register.submit',
    'loginRoute'     => 'seller.login',
])
