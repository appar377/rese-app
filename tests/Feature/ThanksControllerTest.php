<?php

namespace Tests\Feature;

use Tests\TestCase;

class ThanksControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function indexTest()
    {
        $response = $this->get('/thanks');

        $response->assertStatus(200)->assertViewIs('thanks');
    }
}
