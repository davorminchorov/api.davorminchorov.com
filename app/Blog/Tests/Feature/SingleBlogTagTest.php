<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogPost;
use DavorMinchorov\Blog\Models\BlogTag;
use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SingleBlogTagTest extends TestCase
{
    use RefreshDatabase;

    private string $singleBlogTagRouteName = 'v1.blog.single-tag';

    /**
     * @test
     */
    public function it_shows_a_list_of_published_blog_posts_filtered_by_a_specific_blog_tag_slug(): void
    {
        $user = User::factory()->create();
        $publishedBlogPosts = BlogPost::factory()
            ->times(3)
            ->hasAttached($blogTags = BlogTag::factory()->times(count: 5))
            ->published()
            ->create([
                'user_id' => $user->id,
            ]);
        $blogTagSlug = $publishedBlogPosts->first()->blogTags()->first()->slug;

        $response = $this->getJson(route($this->singleBlogTagRouteName, [
            'slug' => $blogTagSlug
        ]));

        /** @var BlogTag $blogTag */
        $blogTag = BlogTag::where('slug', $blogTagSlug)->with('blogPosts')->first();

        $blogPosts = $blogTag->blogPosts;

        $response->assertExactJson($this->blogPostsJsonResponseStructure($blogPosts));

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
                        'publishDate' => $publishedBlogPost->published_at?->format('F j, Y H:i:s'),
                    ],
                    'relationships' => [
                        'tags' => $this->blogTagsJsonResponseStructure($publishedBlogPost->blogTags),
                    ],
                ];
            })->sortByDesc(callback: 'publishDate')->toArray(),
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
