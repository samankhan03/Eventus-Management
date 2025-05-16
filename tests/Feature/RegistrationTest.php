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
            'name' => 'Mr. Ethan Holloway',
            'email' => 'ethan.holloway@example.com',
            'password' => 'securePass123',
            'password_confirmation' => 'securePass123',
            'username' => 'ethan_holloway',
            'gender' => 'male',
        ]);
    
        $response->assertStatus(302);
  $user = User::where('email', 'ethan.holloway@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Mr. Ethan Holloway', $user->name);
        $this->assertEquals('ethan.holloway@example.com', $user->email);
    }
}    