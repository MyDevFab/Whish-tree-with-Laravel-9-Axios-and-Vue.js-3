<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_category_can_be_added_to_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $category = $this->post('api/categories', [
            'name' => 'Category test',
            'user_id' => $user->id,
        ]);

        $category->assertCreated();
        $this->assertCount(1, Category::all());
    }

    public function test_an_empty_category_cannot_be_added_to_database()
    {
        $response = $this->post('/api/categories', [
            'name' => '',
            'user_id' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'user_id']);
    }

    public function test_a_category_can_be_updated_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->post('api/categories', [
            'name' => 'Category test',
            'user_id' => $user->id,
        ]);

        $category = Category::first();

        $this->patch('api/categories/'. $category->id, [
            'name' => 'Category updated',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Category updated', Category::first()->name);
        $this->assertEquals($user->id, Category::first()->user_id);
    }

    public function test_a_category_can_be_deleted_from_database()
    {
        $this->post('/api/register', [
            'name' => 'New user',
            'avatar' => 'default',
            'email' => 'NewUser@mail.com',
            'password' => 'password',
            'c_password' => 'password',
        ]);

        $user = User::first();

        $this->post('api/categories', [
            'name' => 'Category test',
            'user_id' => $user->id,
        ]);

        $category = Category::first();

        $this->delete('api/categories/'. $category->id);

        $this->assertCount(0, Category::all());
    }
}
