<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    public function test_profile_information_can_be_updated()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->put('/user/profile-information', [
            'name' => 'Amelia Rhodes',
            'email' => 'amelia.rhodes@example.com',
            'username' => 'amelia_rhodes_23',
        ]);

    $response->assertSessionHasNoErrors();

    $user = $user->fresh();

   $this->assertEquals('Amelia Rhodes', $user->name);
    $this->assertEquals('amelia.rhodes@example.com', $user->email);
    $this->assertEquals('amelia_rhodes_23', $user->username);
}
}    