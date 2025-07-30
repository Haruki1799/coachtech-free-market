<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test1_2 extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function メールが未入力の場合はバリデーションエラーになる()
    {
        $this->withExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => '', // 未入力
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
