<?php

namespace DavorMinchorov\Authentication\Tests\Feature;

use DavorMinchorov\Framework\Tests\TestCase;
use DavorMinchorov\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private string $loginRouteName = 'v1.authentication.login';

    /**
     * @var string
     */
    private string $logoutRouteName = 'v1.authentication.logout';

    /**
     * @test
     */
    public function a_user_gets_an_access_token_when_trying_to_login_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->loginRouteName), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $jsonResponse = $response->json();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'data' => [
                'id' => $user->uuid,
                'type' => 'users',
                'attributes' => [
                    'name' => $user->name,
                    'accessToken' => $jsonResponse['data']['attributes']['accessToken'],
                ],
            ]
        ]);

        $this->assertCount(1, $user->tokens);
    }

    /**
     * @test
     */
    public function a_user_gets_unauthorized_error_with_when_trying_to_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route($this->loginRouteName), [
            'email' => 'test@example.com',
            'password' => 'secret',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The provided credentials are incorrect.'
                ]
            ]
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_logout(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson(route($this->logoutRouteName));

        $response->assertNoContent();

        $this->assertCount(0, $user->tokens);
    }

    /**
     * @test
     */
    public function a_guest_cannot_logout(): void
    {
        $response = $this->postJson(route($this->logoutRouteName));

        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function the_email_field_is_required(): void
    {
        $response = $this->postJson(route($this->loginRouteName), [
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email field is required.',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function the_password_field_is_required(): void
    {
        $response = $this->postJson(route($this->loginRouteName), [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    'The password field is required.',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function the_email_field_must_be_an_email(): void
    {
        $response = $this->postJson(route($this->loginRouteName), [
            'email' => 'test',
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email must be a valid email address.',
                ],
            ],
        ]);
    }
}
