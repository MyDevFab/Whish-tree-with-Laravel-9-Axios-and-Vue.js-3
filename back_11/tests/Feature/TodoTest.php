<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use App\Models\Tree;
use App\Models\User;
use App\Models\Resolution;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_todo_can_be_added_to_database()
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

        $this->post('api/resolutions', [
            'title' => 'Resolution test',
            'tree_id' => $tree->id,
            'category_id' => null
        ]);

        $resolution = Resolution::first();

        $todo = $this->post('api/todos', [
            'resolution_id' => $resolution->id,
            'content' => 'Todo test'
        ]);

        $todo->assertCreated();
        $this->assertCount(1, Todo::all());
    }

    public function test_an_empty_todo_cannot_be_added_to_database()
    {
        $response = $this->post('/api/todos', [
            'resolution_id' => '',
            'content' => ''
        ]);

        $response->assertSessionHasErrors(['resolution_id', 'content']);
    }

    public function test_a_todo_can_be_updated_from_database()
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

        $this->post('api/resolutions', [
            'title' => 'Resolution test',
            'tree_id' => $tree->id,
            'category_id' => null
        ]);

        $resolution = Resolution::first();

        $this->post('api/todos', [
            'resolution_id' => $resolution->id,
            'content' => 'Todo test'
        ]);

        $todo = Todo::first();

        $this->patch('api/todos/'. $todo->id, [
            'resolution_id' => $resolution->id,
            'content' => 'Todo updated'
        ]);

        $this->assertEquals('Todo updated', Todo::first()->content);
        $this->assertEquals($resolution->id, Todo::first()->resolution_id);
    }

    public function test_a_todo_can_be_deleted_from_database()
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

        $this->post('api/resolutions', [
            'title' => 'Resolution test',
            'tree_id' => $tree->id,
            'category_id' => null
        ]);

        $resolution = Resolution::first();

        $this->post('api/todos', [
            'resolution_id' => $resolution->id,
            'content' => 'Todo test'
        ]);

        $todo = Todo::first();

        $this->delete('api/todos/'. $todo->id);

        $this->assertCount(0, Todo::all());
    }
}
