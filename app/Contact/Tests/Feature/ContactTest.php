<?php

namespace DavorMinchorov\Contact\Tests\Feature;

use DavorMinchorov\Contact\Mail\SendContactEmail;
use DavorMinchorov\Framework\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private string $contactRouteName = 'v1.contact';

    /**
     * @test
     */
    public function a_visitor_can_send_a_contact_email(): void
    {
        Mail::fake();

        Mail::assertNotQueued(SendContactEmail::class);

        $response = $this->postJson(route($this->contactRouteName), [
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'message' => 'This is a test message',
        ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        Mail::assertQueued(SendContactEmail::class);
    }

    /**
     * @test
     * @dataProvider contactValidationDataProvider
     *
     * @param string $field
     * @param mixed $value
     *
     * @return void
     */
    public function check_contact_validation_errors(string $field, mixed $value): void
    {
        $response = $this->postJson(route($this->contactRouteName), [
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'message' => 'This is a test message',
            $field => $value,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors($field);
    }

    /**
     * The data provider for the contact validation errors.
     *
     * @return array
     */
    public function contactValidationDataProvider(): array
    {
        return [
            'The name field is required' => ['name', ''],
            'The email field is required' => ['email', ''],
            'The email must be a valid email address' => [
                'email',
                'invalidemailaddress',
            ],
            'The email must be a valid email address with a valid domain' => [
                'email',
                'test@adomainthatdoesnotexist.com',
            ],
            'The email must be a valid email address with a valid RFC format' => [
                'email',
                'op[p[p[opopl;[@gmail.com',
            ],
            'The message field is required' => ['message', ''],

        ];
    }
}
