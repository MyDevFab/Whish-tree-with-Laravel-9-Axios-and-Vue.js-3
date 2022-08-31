<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tree;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TreeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_tree_can_be_added_to_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $tree = $this->post('api/trees', [
            'title' => 'Tree test',
            'user_id' => $user->id,
            'active' => true
        ]);

        $tree->assertCreated();
        $this->assertCount(1, Tree::all());
    }


    public function test_an_empty_tree_cannot_be_added_to_database()
    {
        $response = $this->post('/api/trees', [
            'title' => '',
            'user_id' => '',
            'active' => true,
        ]);

        $response->assertSessionHasErrors(['title', 'user_id']);
    }

    public function test_a_tree_can_be_updated_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->post('api/trees', [
            'title' => 'Tree test',
            'user_id' => $user->id,
            'active' => true
        ]);

        $tree = Tree::first();

        $this->patch('api/trees/'. $tree->id, [
            'title' => 'Tree updated',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Tree updated', Tree::first()->title);
        $this->assertEquals($user->id, Tree::first()->user_id);
        $this->assertEquals(true, Tree::first()->active);
    }

    public function test_a_tree_can_be_deleted_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->post('api/trees', [
            'title' => 'Tree test',
            'user_id' => $user->id,
            'active' => true
        ]);

        $tree = Tree::first();

        $this->delete('api/trees/'. $tree->id);

        $this->assertCount(0, Tree::all());
    }
}
