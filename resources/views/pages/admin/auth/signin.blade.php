@include('pages.auth.signin', [
    'title' => $title ?? 'Admin Sign In',
    'guard' => 'admin',
    'loginRoute' => 'admin.login.submit',
])
