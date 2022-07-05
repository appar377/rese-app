<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Reserve;
use App\Models\User;

class ReserveControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $reserve;
    protected $leader;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role', 0)->first();

        $this->reserve = Reserve::factory()->create();

        $this->leader = User::factory()->state(['role' => 5])->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function storeTest()
    {
        $response = $this->actingAs($this->user)->post('/reserve', [
            'user_id' => 3,
            'shop_id' => 1,
            'number' => 5,
            'date' => date('Y-m-d', strtotime(now() . '+1 day')),
            'time' => '19:00',
        ]);

        $response->assertStatus(302)->assertRedirect('/done');

        $this->assertDatabaseHas('reserves', [
            'user_id' => 3,
            'shop_id' => 1,
            'number' => 5,
            'date' => date('Y-m-d', strtotime(now() . '+1 day')),
            'time' => '19:00',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function updateTest()
    {
        $response = $this->actingAs($this->user)->post('/reserve/update', [
            'reserve_id' => $this->reserve['id'],
            'date' => date('Y-m-d', strtotime(now() . '+1 day')),
            'time' => date('H:i'),
            'number' => 3,
        ]);

        $response->assertStatus(302)->assertRedirect('/mypage');

        $this->assertDatabaseHas('reserves', [
            'id' => $this->reserve['id'],
            'date' => date('Y-m-d', strtotime(now() . '+1 day')),
            'time' => date('H:i'),
            'number' => 3,
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
        $response = $this->actingAs($this->user)->post('/reserve/delete', [
            'reserve_id' => $this->reserve['id'],
        ]);

        $response->assertStatus(302)->assertRedirect('/mypage');

        $this->assertSoftDeleted('reserves', [
            'id' => $this->reserve['id']
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function doneTest()
    {
        $response = $this->actingAs($this->user)->get('/done');

        $response->assertStatus(200)->assertViewIs('done');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function reserve_confirmationTest()
    {
        $response = $this->actingAs($this->leader)->get('reserve/1');
        $response->assertStatus(200)->assertViewIs('reserve_confirmation');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function collationTest()
    {

        $response = $this->get('collation/'.$this->reserve['id']);

        $response->assertStatus(200)->assertViewIs('collation');

        $updateReserve = Reserve::find($this->reserve['id']);

        $this->assertEquals(true, $updateReserve['visited']);
    }
}
