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
            'name' => 'Tyrell Simonis',
            'email' => 'unique_email@example.com',
            'username' => 'bashirian.toy',
        ]);

    $response->assertSessionHasNoErrors();

    $user = $user->fresh();

    $this->assertEquals('Tyrell Simonis', $user->name);
    $this->assertEquals('unique_email@example.com', $user->email);
    $this->assertEquals('bashirian.toy', $user->username);
}
}    