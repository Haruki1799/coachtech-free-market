<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Test2_2 extends TestCase
{
    /** @test */
    public function パスワードが未入力の場合はバリデーションエラーになる()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withExceptionHandling();

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => '', // 未入力

        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
