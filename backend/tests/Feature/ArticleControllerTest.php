<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    //use DatabaseMigrations;

    //use RefreshDatabase;

    use DatabaseTransactions;

    public function test_any_user_can_view_all_articles()
    {
        $response = $this->get('/api/articles');

        $response->assertStatus(200);

        $response->assertJson(['per_page' => 5]);
    }

    public function test_only_authenticated_user_can_create_article()
    {
        $user = User::factory(1)->create()[0];

        $category = Category::factory(1)->create()[0];

        $response = $this
            ->actingAs($user)
            ->post(
                "/api/articles",
                [
                    'title' => 'MY TEST',
                    'content' => 'test !!!',
                    'categories_id' => [$category->id]
                ],
                [
                    'Accept' => 'application/json'
                ]
            );


        $response->assertStatus(201);
        $this->assertEquals($user->id, $response['user_id']);
    }
}
