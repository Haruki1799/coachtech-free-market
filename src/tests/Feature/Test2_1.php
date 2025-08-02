<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Test2_1 extends TestCase
{
    /** @test */
    public function メールが未入力の場合はバリデーションエラーになる()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withExceptionHandling();

        $response = $this->post('/login', [
            'email' => '', // 未入力
            'password' => 'password123',

        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
