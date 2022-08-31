<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tree;
use App\Models\User;
use App\Models\Resolution;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResolutionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_resolution_can_be_added_to_database()
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

        $resolution = $this->post('api/resolutions', [
            'title' => 'Resolution test',
            'tree_id' => $tree->id,
            'category_id' => null
        ]);

        $resolution->assertCreated();
        $this->assertCount(1, Resolution::all());
    }

    public function test_an_empty_resolution_cannot_be_added_to_database()
    {
        $resolution = $this->post('/api/resolutions', [
            'title' => '',
            'tree_id' => '',
            'category_id' => null
        ]);

        $resolution->assertSessionHasErrors(['title', 'tree_id']);
    }

    public function test_a_resolution_can_be_updated_from_database()
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

        $this->patch('api/resolutions/'. $resolution->id, [
            'title' => 'Resolution updated',
            'tree_id' => $tree->id,
            'category_id' => null
        ]);

        $this->assertEquals('Resolution updated', Resolution::first()->title);
        $this->assertEquals($tree->id, Resolution::first()->tree_id);
        $this->assertEquals(null, Resolution::first()->category_id);
    }

    public function test_a_resolution_can_be_deleted_from_database()
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

        $this->delete('api/resolutions/'. $resolution->id);

        $this->assertCount(0, Resolution::all());
    }
}
