<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_user_can_be_added_to_database()
    {
        $response = $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $response->assertOk();
        $this->assertCount(1, User::all());
    }

    public function test_an_empty_user_cannot_be_added_to_database()
    {
        $response = $this->post('/api/register', [
            'name' => '',
            'avatar' => '',
            'email' => '',
            'password' => '',
            'c_password' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'avatar', 'email', 'password', 'c_password']);
    }

    public function test_a_user_can_be_updated_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->patch('api/users/'. $user->id, [
            'name' => 'New user updated',
            'avatar' => 'default',
            'email' => 'NewUserUpdated@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $this->assertEquals('New user updated', User::first()->name);
        $this->assertEquals($user->id, User::first()->id);
        $this->assertEquals('NewUserUpdated@mail.com', User::first()->email);
        $this->assertEquals('password', User::first()->password);
    }

    public function test_a_user_can_be_deleted_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->delete('api/users/'. $user->id);

        $this->assertCount(0, User::all());
    }
}
