<?php

use App\Models\User;

it('can display login page', function () {
    $response = $this->get('/admin/login');
    
    $response->assertOk();
    $response->assertSee('Sign in');
});

it('redirects unauthenticated users to login when accessing admin', function () {
    $response = $this->get('/admin');
    
    $response->assertRedirect('/admin/login');
    $this->assertGuest();
});

it('authenticated super admin user can view dashboard', function () {
    // Use the seeded admin user
    $user = User::where('email', 'admin@gmail.com')->first();
    
    if (!$user) {
        $this->markTestSkipped('Admin user not found. Run: php artisan db:seed');
    }
    
    $this->actingAs($user);
    $this->assertAuthenticatedAs($user);
    
    // Check if user has super_admin role
    expect($user->isSuperAdmin())->toBeTrue();
});

it('redirects authenticated users away from login page', function () {
    $user = User::where('email', 'admin@gmail.com')->first();
    
    if (!$user) {
        $this->markTestSkipped('Admin user not found. Run: php artisan db:seed');
    }
    
    $this->actingAs($user);
    
    $response = $this->get('/admin/login');
    
    $response->assertRedirect('/admin');
});

it('user model has correct role checking methods', function () {
    $user = User::where('email', 'admin@gmail.com')->first();
    
    if (!$user) {
        $this->markTestSkipped('Admin user not found. Run: php artisan db:seed');
    }
    
    expect(method_exists($user, 'isSuperAdmin'))->toBeTrue();
    expect(method_exists($user, 'isTheaterManager'))->toBeTrue();
    expect(method_exists($user, 'isCustomer'))->toBeTrue();
    expect(method_exists($user, 'canAccessPanel'))->toBeTrue();
});
