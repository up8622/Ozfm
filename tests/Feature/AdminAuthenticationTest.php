<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_login_with_correct_credentials()
    {
        $admin = Administrator::create([
            'ime' => 'Admin',
            'prezime' => 'User',
            'godina_rodjenja' => 1980,
            'username' => 'admin',
            'hash' => bcrypt('admin123'),
        ]);

        $loginData = [
            'user_type' => 'admin',
            'username' => 'admin',
            'password' => 'admin123',
        ];

        $response = $this->withoutMiddleware()->post(route('admin.login'), $loginData);

        $response->assertRedirect('/admin');
        $response->assertSessionHas('success');
        $this->assertEquals(session('admin_id'), $admin->id);
        $this->assertEquals(session('admin_name'), 'Admin User');
    }

    /** @test */
    public function admin_cannot_login_with_wrong_password()
    {
        Administrator::create([
            'ime' => 'Admin',
            'prezime' => 'User',
            'godina_rodjenja' => 1980,
            'username' => 'admin',
            'hash' => bcrypt('admin123'),
        ]);

        $loginData = [
            'user_type' => 'admin',
            'username' => 'admin',
            'password' => 'wrongpassword',
        ];

        $response = $this->withoutMiddleware()->post(route('admin.login'), $loginData);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('/login');
        $this->assertNull(session('admin_id'));
    }

    /** @test */
    public function admin_can_logout()
    {
        // First login
        $admin = Administrator::create([
            'ime' => 'Admin',
            'prezime' => 'User',
            'godina_rodjenja' => 1980,
            'username' => 'admin',
            'hash' => bcrypt('admin123'),
        ]);

        $this->withoutMiddleware()->post(route('admin.login'), [
            'user_type' => 'admin',
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        // Then logout
        $response = $this->get(route('admin.logout'));

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $this->assertNull(session('admin_id'));
        $this->assertNull(session('admin_name'));
    }

    /** @test */
    public function admin_routes_require_authentication()
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('login');
    }
}