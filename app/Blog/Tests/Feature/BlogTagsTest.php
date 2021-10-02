<?php

namespace DavorMinchorov\Blog\Tests\Feature;

use DavorMinchorov\Blog\Models\BlogTag;
use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
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
        $tags = BlogTag::factory()->times(5)->create();
        $response = $this->getJson(route($this->blogTagsRouteName));

        $response->assertExactJson($this->blogTagsJsonResponseStructure($tags));

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
