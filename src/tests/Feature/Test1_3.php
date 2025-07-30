<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test1_3 extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function パスワードが未入力の場合はバリデーションエラーになる()
    {
        $this->withExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '', // 未入力
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
