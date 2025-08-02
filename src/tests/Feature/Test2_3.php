<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Test2_3 extends TestCase
{
    /** @test */
    public function ログイン情報が登録されていない場合はバリデーションエラーになる()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withExceptionHandling();

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',

        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
