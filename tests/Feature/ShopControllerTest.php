<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ShopControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $shop;
    protected $leader;
    protected $file;
    protected $oldImg;
    protected $genres;
    protected $areas;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->leader = User::where('role', 5)->first();

        $this->shop = Shop::find(1);

        Storage::fake('public');

        $this->file = UploadedFile::fake()->image('test.jpg');

        $this->oldImg = $this->shop['img'];

        $this->genres = Genre::all();
        $this->areas = Area::all();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function storeTest()
    {

        $response = $this->actingAs($this->leader)->post('/shop/store', [
            'name' => '焼き肉ハウス',
            'user_id' => 2,
            'area_id' => 1,
            'genre_id' => 2,
            'course' => '豪華コース',
            'price' => 6000, 
            'content' => '全国で大人気焼き肉ハウスです。',
            'img' => $this->file,
        ]);


        Storage::disk('public')->assertExists('/img/'.$this->file->hashName());

        $response->assertStatus(302);

        $this->assertDatabaseHas('shops', [
            'name' => '焼き肉ハウス',
            'user_id' => 2,
            'area_id' => 1,
            'genre_id' => 2,
            'course' => '豪華コース',
            'price' => 6000, 
            'content' => '全国で大人気焼き肉ハウスです。',
            'img' => 'img/'.$this->file->hashName(),
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
        $response = $this->actingAs($this->leader)->post('/shop/update', [
            'shop_id' => $this->shop['id'],
            'name' => 'Jack',
            'area_id' => 1,
            'genre_id' => 1,
            'content' => '絶品料理店です。',
            'img' => $this->file,
            'oldImg' => $this->oldImg,
            'price' => 10000, 
            'course' => '高級コース',
        ]);

        Storage::disk('public')->assertExists('/img/'.$this->file->hashName());

        Storage::disk('public')->assertMissing('/img/'.$this->oldImg);

        $response->assertStatus(302)->assertRedirect('/create_shop');

        $this->assertDatabaseHas('shops', [
            'id' => $this->shop['id'],
            'name' => 'Jack',
            'area_id' => 1,
            'genre_id' => 1,
            'content' => '絶品料理店です。',
            'price' => 10000, 
            'course' => '高級コース',
            'img' => 'img/'.$this->file->hashName(),
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function deleteTest()
    {
        $response = $this->actingAs($this->leader)->post('/shop/delete', [
            'shop_id' => 1,
        ]);

        $response->assertStatus(302)->assertRedirect('/create_shop');

        $this->assertDeleted('shops', [
            'id' => 1,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function indexTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200)->assertViewIs('index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function detailTest()
    {
        $response = $this->get('/detail/1');

        $response->assertStatus(200)->assertViewIs('detail');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function createTest()
    {
        
        $response = $this->actingAs($this->leader)->get('/create_shop');

        $response->assertStatus(200)->assertViewIs('create_shop');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function searchTest()
    {
        $response = $this->call('GET', '/search', [
            'area_id' => 1,
            'genre_id' => 1,
            'search' => '仙',
        ]);

        $response->assertStatus(200);

        $response->assertSeeText('仙人');

        $response->assertDontSeeText('牛助');
    }
}

