<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test1_5 extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 確認パスワードと異なるパスワードの場合はバリデーションエラーになる()
    {
        $this->withExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password345',//異なるパスワード
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
