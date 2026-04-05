<?php

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

dataset('guard-auth-cases', [
    'admin' => [
        'guard' => 'admin',
        'model' => Admin::class,
        'login' => 'admin.login',
        'login_submit' => 'admin.login.submit',
        'logout' => 'admin.logout',
        'dashboard' => 'admin.dashboard',
    ],
    'seller' => [
        'guard' => 'seller',
        'model' => Seller::class,
        'login' => 'seller.login',
        'login_submit' => 'seller.login.submit',
        'logout' => 'seller.logout',
        'dashboard' => 'seller.dashboard',
    ],
    'customer' => [
        'guard' => 'customer',
        'model' => Customer::class,
        'login' => 'customer.login',
        'login_submit' => 'customer.login.submit',
        'logout' => 'customer.logout',
        'dashboard' => 'customer.dashboard',
    ],
]);

dataset('guard-register-cases', [
    'seller' => [
        'guard' => 'seller',
        'model' => Seller::class,
        'register' => 'seller.register',
        'register_submit' => 'seller.register.submit',
        'login' => 'seller.login',
        'dashboard' => 'seller.dashboard',
    ],
    'customer' => [
        'guard' => 'customer',
        'model' => Customer::class,
        'register' => 'customer.register',
        'register_submit' => 'customer.register.submit',
        'login' => 'customer.login',
        'dashboard' => 'customer.dashboard',
    ],
]);

it('allows guest access to the login page and protects dashboard routes', function (
    string $guard,
    string $model,
    string $login,
    string $login_submit,
    string $logout,
    string $dashboard
): void {
    $this->get(route($login))
        ->assertOk();

    $this->get(route($dashboard))
        ->assertRedirect(route($login));
})->with('guard-auth-cases');

it('authenticates users with valid credentials per guard', function (
    string $guard,
    string $model,
    string $login,
    string $login_submit,
    string $logout,
    string $dashboard
): void {
    $password = 'password123';

    $user = $model::query()->create([
        'name' => ucfirst($guard).' User',
        'email' => $guard.'@example.com',
        'password' => $password,
    ]);

    $this->post(route($login_submit), [
        'email' => $user->email,
        'password' => $password,
    ])->assertRedirect(route($dashboard));

    $this->assertAuthenticatedAs($user, $guard);

    $this->get(route($dashboard))
        ->assertOk();
})->with('guard-auth-cases');

it('rejects invalid credentials per guard', function (
    string $guard,
    string $model,
    string $login,
    string $login_submit,
    string $logout,
    string $dashboard
): void {
    $model::query()->create([
        'name' => ucfirst($guard).' User',
        'email' => $guard.'@example.com',
        'password' => 'password123',
    ]);

    $this->post(route($login_submit), [
        'email' => $guard.'@example.com',
        'password' => 'invalid-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest($guard);
})->with('guard-auth-cases');

it('allows guest access to the register page', function (
    string $guard,
    string $model,
    string $register,
    string $register_submit,
    string $login,
    string $dashboard
): void {
    $this->get(route($register))
        ->assertOk();
})->with('guard-register-cases');

it('registers a new user and authenticates per guard', function (
    string $guard,
    string $model,
    string $register,
    string $register_submit,
    string $login,
    string $dashboard
): void {
    $password = 'password123';

    $this->post(route($register_submit), [
        'first_name'            => 'Test',
        'last_name'             => ucfirst($guard),
        'email'                 => $guard . '@example.com',
        'password'              => $password,
        'password_confirmation' => $password,
        'terms'                 => '1',
    ])->assertRedirect(route($dashboard));

    $this->assertAuthenticated($guard);

    $user = $model::query()->where('email', $guard . '@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Test ' . ucfirst($guard));
})->with('guard-register-cases');

it('rejects registration with duplicate email per guard', function (
    string $guard,
    string $model,
    string $register,
    string $register_submit,
    string $login,
    string $dashboard
): void {
    $model::query()->create([
        'name'  => 'Existing User',
        'email' => $guard . '@example.com',
        'password' => 'password123',
    ]);

    $password = 'password123';

    $this->post(route($register_submit), [
        'first_name'            => 'Test',
        'last_name'             => ucfirst($guard),
        'email'                 => $guard . '@example.com',
        'password'              => $password,
        'password_confirmation' => $password,
        'terms'                 => '1',
    ])->assertSessionHasErrors('email');

    $this->assertGuest($guard);
})->with('guard-register-cases');

it('rejects registration with mismatched passwords per guard', function (
    string $guard,
    string $model,
    string $register,
    string $register_submit,
    string $login,
    string $dashboard
): void {
    $this->post(route($register_submit), [
        'first_name'            => 'Test',
        'last_name'             => ucfirst($guard),
        'email'                 => $guard . '@example.com',
        'password'              => 'password123',
        'password_confirmation' => 'different456',
        'terms'                 => '1',
    ])->assertSessionHasErrors('password');

    $this->assertGuest($guard);
})->with('guard-register-cases');

it('logs out authenticated users per guard', function (
    string $guard,
    string $model,
    string $login,
    string $login_submit,
    string $logout,
    string $dashboard
): void {
    $password = 'password123';

    $user = $model::query()->create([
        'name' => ucfirst($guard).' User',
        'email' => $guard.'@example.com',
        'password' => $password,
    ]);

    $this->actingAs($user, $guard);

    $this->post(route($logout))
        ->assertRedirect(route($login));

    $this->assertGuest($guard);

    $this->get(route($dashboard))
        ->assertRedirect(route($login));
})->with('guard-auth-cases');
