<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Good;
use App\Models\User;


class Test4_1 extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_goods_list(): void
    {
        $user = User::factory()->create();
        Good::create(['item' => 'りんご', 'price' => 300, 'user_id' => $user->id]);

        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertSee('りんご');
    }

    public function test_guest_can_view_good_detail(): void
    {
        $user = User::factory()->create();
        $good = Good::create(['item' => 'みかん', 'price' => 200, 'user_id' => $user->id]);

        $response = $this->get('/items/' . $good->id);
        $response->assertStatus(200);
        $response->assertSee('みかん');
    }
}
