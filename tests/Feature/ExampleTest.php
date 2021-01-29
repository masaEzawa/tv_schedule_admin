<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    public function setUp() :void
    {
        parent::setUp();
        
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // 準備

        // 実行
        $response = $this->get('/');

        // 検証
        // $response->assertStatus(200);
        $response->assertStatus(302);  // ステータスコードを変更
    }
}
