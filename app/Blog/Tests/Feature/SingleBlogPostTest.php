<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Blog\Models\BlogTag;
use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $publishedBlogPost = BlogPost::factory()
            ->published()
            ->hasAttached(BlogTag::factory()->times(count: 5))
            ->create(attributes: [
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(uri: route(name: $this->singleBlogPostRouteName, parameters: [
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
                    'publishDate' => $publishedBlogPost->published_at->format('F j, Y H:i:s'),
                ],
                'relationships' => [
                    'tags' => $this->blogTagsJsonResponseStructure($publishedBlogPost->blogTags),
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
        $publishedBlogPost = BlogPost::factory()->published()->create(attributes: [
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(uri: route(name: $this->singleBlogPostRouteName, parameters: [
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
        $draftBlogPost = BlogPost::factory()->draft()->create(attributes: [
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(uri: route(name: $this->singleBlogPostRouteName, parameters: [
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
        $scheduledBlogPost = BlogPost::factory()->scheduled()->create(attributes: [
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(uri: route(name: $this->singleBlogPostRouteName, parameters: [
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
        $archivedBlogPost = BlogPost::factory()->archived()->create(attributes: [
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(uri: route(name: $this->singleBlogPostRouteName, parameters: [
            'slug' => $archivedBlogPost->slug,
        ]));

        $response->assertNotFound();
    }

    /**
     * Returns the JSON structure for the blog tags.
     *
     * @param Collection $blogTags
     * @return array
     */
    private function blogTagsJsonResponseStructure(Collection $blogTags): array
    {
        return [
            'data' => $blogTags->map(function (BlogTag $blogTag) {
                return [
                    'id' => $blogTag->uuid,
                    'type' => 'blogTags',
                    'attributes' => [
                        'name' => $blogTag->name,
                        'slug' => $blogTag->slug,
                    ],
                ];
            })->toArray(),
        ];
    }
}
