<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Dr. Paige McGlynn I',
            'email' => 'hudson.kevon@example.org',
            'password' => 'password',
            'password_confirmation' => 'password',
            'username' => 'paige_mcglynn',
            'gender' => 'female',
        ]);
    
        $response->assertStatus(302);
        $user = User::where('email', 'hudson.kevon@example.org')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Dr. Paige McGlynn I', $user->name);
        $this->assertEquals('hudson.kevon@example.org', $user->email);
    }
}    