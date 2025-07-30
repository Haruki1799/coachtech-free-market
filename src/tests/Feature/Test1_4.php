<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test1_4 extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function パスワードが７文字以下の場合はバリデーションエラーになる()
    {
        $this->withExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'pass', // 7文字以下
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
