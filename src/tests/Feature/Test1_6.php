<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test1_6 extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 全ての項目が入力されている場合、会員登録がされてログイン画面に遷移する()
    {
        $this->withExceptionHandling();

        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'test',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('mypage_profile'));
    }
}
