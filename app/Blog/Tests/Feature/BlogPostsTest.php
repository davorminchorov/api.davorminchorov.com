<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Blog\Models\BlogTag;
use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostsTest extends TestCase
{
    use RefreshDatabase;

    private string $blogPostsRouteName = 'v1.blog.posts';

    /**
     * @test
     */
    public function it_shows_a_list_of_published_blog_posts(): void
    {
        $user = User::factory()->create();
        $publishedBlogPosts = BlogPost::factory()
            ->times(3)
            ->hasAttached(BlogTag::factory()->times(count: 5))
            ->published()
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route($this->blogPostsRouteName));

        $response->assertExactJson($this->blogPostsJsonResponseStructure($publishedBlogPosts));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_does_not_show_a_list_of_draft_blog_posts(): void
    {
        $user = User::factory()->create();
        $publishedPost = BlogPost::factory()->published()->create([
            'user_id' => $user->id,
        ]);
        $draftBlogPost = BlogPost::factory()->draft()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(route($this->blogPostsRouteName));

        $response->assertDontSeeText($draftBlogPost->title);
        $response->assertSeeText($publishedPost->title);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_does_not_show_a_list_of_scheduled_blog_posts(): void
    {
        $user = User::factory()->create();
        $publishedPost = BlogPost::factory()->published()->create([
            'user_id' => $user->id,
        ]);
        $scheduledBlogPost = BlogPost::factory()->scheduled()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(route($this->blogPostsRouteName));

        $response->assertDontSeeText($scheduledBlogPost->title);
        $response->assertSeeText($publishedPost->title);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_does_not_show_a_list_of_archived_blog_posts(): void
    {
        $user = User::factory()->create();
        $publishedPost = BlogPost::factory()->published()->create([
            'user_id' => $user->id,
        ]);
        $archivedBlogPost = BlogPost::factory()->archived()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(route($this->blogPostsRouteName));

        $response->assertDontSeeText($archivedBlogPost->title);
        $response->assertSeeText($publishedPost->title);
        $response->assertOk();
    }

    /**
     * Returns the JSON structure for the published blog posts.
     *
     * @param Collection $publishedBlogPosts
     * @return array
     */
    private function blogPostsJsonResponseStructure(Collection $publishedBlogPosts): array
    {
        return [
            'data' => $publishedBlogPosts->map(function (BlogPost $publishedBlogPost) {
                return [
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
                        'tags' => $this->blogTagsJsonResponseStructure($publishedBlogPost->blogTags)
                    ],
                ];
            })->sortByDesc('publishDate')->toArray(),
        ];
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
