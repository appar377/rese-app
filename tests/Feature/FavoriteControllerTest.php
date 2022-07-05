<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Favorite;
use App\Models\User;

class FavoriteControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $favorite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role', 0)->first();

        $this->favorite = Favorite::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function storeTest()
    {
        $response = $this->actingAs($this->user)->post('/favorite', [
            'user_id' => 3,
            'shop_id' => 1,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('favorites', [
            'user_id' => 3,
            'shop_id' => 1,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function destroyTest()
    {
        $response = $this->actingAs($this->user)->post('/favorite/delete', [
            'user_id' => $this->favorite->user_id,
            'shop_id' => $this->favorite->shop_id
        ]);

        $response->assertStatus(302);

        $this->assertDeleted('favorites', [
            'user_id' => $this->favorite->user_id,
            'shop_id' => $this->favorite->shop_id
        ]);
    }
}
