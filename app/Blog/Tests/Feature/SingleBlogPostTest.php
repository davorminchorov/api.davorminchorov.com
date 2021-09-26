<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;

class SingleBlogPostTest extends TestCase
{
    use RefreshDatabase;

    private string $singleBlogPostRouteName = 'v1.blog.single-post';

    /**
     * @test
     */
    public function it_gets_a_single_blog_post_by_slug(): void
    {
        $user = User::factory()->create();
        $publishedBlogPost = BlogPost::factory()->published()->create([
            'user_uuid' => Uuid::fromString(strtolower($user->uuid))->getBytes(),
        ]);

        $response = $this->getJson(route($this->singleBlogPostRouteName, [
            'slug' => $publishedBlogPost->slug,
        ]));

        $response->assertExactJson([
            'data' => [
                'id' => $publishedBlogPost->uuid,
                'type' => 'blogPosts',
                'attributes' => [
                    'title' => $publishedBlogPost->title,
                    'slug' => $publishedBlogPost->slug,
                    'excerpt' => $publishedBlogPost->excerpt,
                    'content' => $publishedBlogPost->content,
                    'publishDate' => $publishedBlogPost->published_at,
                ],
            ]
        ]);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_cannot_get_a_single_blog_post_by_non_existing_slug(): void
    {
        $user = User::factory()->create();
        $publishedBlogPost = BlogPost::factory()->published()->create([
            'user_uuid' => Uuid::fromString(strtolower($user->uuid))->getBytes(),
        ]);

        $response = $this->getJson(route($this->singleBlogPostRouteName, [
            'slug' => 'test',
        ]));

        $response->assertNotFound();
    }


    /**
     * @test
     */
    public function it_cannot_get_a_draft_blog_post_by_slug(): void
    {
        $user = User::factory()->create();
        $draftBlogPost = BlogPost::factory()->draft()->create([
            'user_uuid' => Uuid::fromString(strtolower($user->uuid))->getBytes(),
        ]);

        $response = $this->getJson(route($this->singleBlogPostRouteName, [
            'slug' => $draftBlogPost->slug,
        ]));

        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function it_cannot_get_a_scheduled_blog_post_by_slug(): void
    {
        $user = User::factory()->create();
        $scheduledBlogPost = BlogPost::factory()->scheduled()->create([
            'user_uuid' => Uuid::fromString(strtolower($user->uuid))->getBytes(),
        ]);

        $response = $this->getJson(route($this->singleBlogPostRouteName, [
            'slug' => $scheduledBlogPost->slug,
        ]));

        $response->assertNotFound();
    }


    /**
     * @test
     */
    public function it_cannot_get_a_archived_blog_post_by_slug(): void
    {
        $user = User::factory()->create();
        $archivedBlogPost = BlogPost::factory()->archived()->create([
            'user_uuid' => Uuid::fromString(strtolower($user->uuid))->getBytes(),
        ]);

        $response = $this->getJson(route($this->singleBlogPostRouteName, [
            'slug' => $archivedBlogPost->slug,
        ]));

        $response->assertNotFound();
    }
}
