<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetUserAll()
    {
        $response = $this->request()->json('GET','/api/users');
        $response->assertStatus(200);
    }


}
