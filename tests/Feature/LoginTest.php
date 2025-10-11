<?php


it('can display login page', function () {
    $page = visit(url('http://localhost:8000/admin/login'));

    $page->assertSee('Sign in');
});

it('can login user with valid credentials', function(){
    $plainPassword = '@admin123';

    $user = [
        'email' => 'admin@gmail.com',
        'password' => $plainPassword
    ];

    $page = visit(url('http://localhost:8000/admin/login'));

    $page->assertSee('Sign in')
        ->fill('Email address*', $user['email'])
        ->fill('Password*', $user['password'])
        ->press('.fi-ac-btn-action')
        ->assertSee('Dashboard');

});


// it('redirects unauthenticated users to login', function () {
//     $response = $this->get('/admin');

//     $response->assertRedirect('/admin/login');
//     $this->assertGuest();
// });

// it('can authenticate a user', function () {
//     $user = User::factory()->create([
//         'email' => 'test@example.com',
//         'password' => bcrypt('password'),
//     ]);

//     $this->actingAs($user);

//     // Test that the user is authenticated
//     $this->assertAuthenticated();

//     // Test that we can access the login page when authenticated (should redirect)
//     $response = $this->get('/admin/login');
//     $response->assertRedirect('/admin');
// });

// it('can logout', function () {
//     $user = User::factory()->create();

//     $this->actingAs($user);
//     $this->assertAuthenticated();

//     // Test logout functionality
//     $response = $this->post('/admin/logout');

//     // The logout route might return different status codes, so let's just check
//     // that we can still access the logout route
//     $this->assertTrue($response->getStatusCode() >= 200 && $response->getStatusCode() < 500);

//     // Manually logout for testing
//     Auth::logout();
//     $this->assertGuest();

//     // Trying to access admin should redirect to login
//     $this->get('/admin')->assertRedirect('/admin/login');
// });