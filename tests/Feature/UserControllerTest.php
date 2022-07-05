<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $leader;
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role', 0)->first();

        $this->leader = User::where('role', 5)->first();
        
        $this->manager = User::where('role', 1)->first();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function storeTest()
    {
        $password = Hash::make('123456789');

        $response = $this->actingAs($this->manager)->post('/management/store', [
            'name' => 'jack',
            'email' => 'jack@jack.com',
            'password' => $password,
            'password_confirmation' => '123456789',
            'role' => 5,
            'email_verified_at' => now(),
        ]);

        $response->assertStatus(302)->assertRedirect('/management');

        $this->assertDatabaseHas('users', [
            'name' => 'jack',
            'email' => 'jack@jack.com',
            'role' => 5,
            'email_verified_at' => now(),
        ])->assertTrue(Hash::check(
            '123456789' ,$password
        ));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function deleteTest()
    {
        $response = $this->actingAs($this->manager)->post('management/delete', [
            'user_id' => $this->leader['id'],
        ]);

        $response->assertStatus(302)->assertRedirect('/management');

        $this->assertDeleted('users', [
            'id' => $this->leader['id'],
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function mypageTest()
    {
        $response = $this->actingAs($this->user)->get('/mypage');

        $response->assertStatus(200)->assertViewIs('mypage');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function managementTest()
    {
        $response = $this->actingAs($this->manager)->get('/management');

        $response->assertStatus(200)->assertViewIs('management');
    }
}