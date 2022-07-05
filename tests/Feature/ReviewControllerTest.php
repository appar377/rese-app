<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Reserve;
use App\Models\User;

class ReviewControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $reserve;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::where('role', 0)->first();
        $this->reserve = Reserve::factory()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function storeTest()
    {
        $response = $this->actingAs($this->user)->post('/review', [
            'star' => '5',
            'comment' => 'とても美味しかったです。',
            'reserve_id' => $this->reserve['id'],
        ]);

        $response->assertStatus(302)->assertRedirect('/mypage');

        $this->assertDatabaseHas('reviews', [
            'star' => '5',
            'comment' => 'とても美味しかったです。',
            'reserve_id' => $this->reserve['id'],
        ]);
    }
}
