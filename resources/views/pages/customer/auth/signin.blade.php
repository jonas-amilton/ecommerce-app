@include('pages.auth.signin', [
    'title' => $title ?? 'Customer Sign In',
    'guard' => 'customer',
    'loginRoute' => 'customer.login.submit',
])
