<?php

namespace DavorMinchorov\AboutMe\Tests\Feature;

use DavorMinchorov\AboutMe\Models\AboutMe;
use DavorMinchorov\Framework\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutMeTest extends TestCase
{
    use RefreshDatabase;

    private string $aboutMeRouteName = 'v1.aboutMe';

    /**
     * @test
     */
    public function it_shows_the_about_me_information(): void
    {
        $aboutMe = AboutMe::factory()->create();

        $response = $this->getJson(route($this->aboutMeRouteName));

        $response->assertExactJson([
            'data' => [
                'id' => $aboutMe->uuid,
                'type' => 'aboutMe',
                'attributes' => [
                    'content' => $aboutMe->content,
                ],
            ],
        ]);

        $response->assertOk();
    }

}
