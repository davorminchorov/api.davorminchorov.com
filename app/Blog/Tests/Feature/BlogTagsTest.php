<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogTag;
use DavorMinchorov\Framework\Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTagsTest extends TestCase
{
    use RefreshDatabase;

    private string $blogTagsRouteName = 'v1.blog.tags';

    /**
     * @test
     */
    public function it_shows_a_list_of_blog_tags(): void
    {
        $blogTags = BlogTag::factory()->times(count: 5)->create();
        $response = $this->getJson(uri: route(name: $this->blogTagsRouteName));

        $response->assertExactJson(data: $this->blogTagsJsonResponseStructure(blogTags: $blogTags));

        $response->assertOk();
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
            'data' => $blogTags->map(function ($blogTag) {
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
