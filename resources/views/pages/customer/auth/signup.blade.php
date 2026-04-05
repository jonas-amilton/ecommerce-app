@include('pages.auth.signup', [
    'title'          => $title ?? 'Customer Sign Up',
    'guard'          => 'customer',
    'registerRoute'  => 'customer.register.submit',
    'loginRoute'     => 'customer.login',
])
