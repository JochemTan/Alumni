<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $this->assertTrue(true);
        $this->visit('/login')
        	->type('phpunit@test.nl','email')
        	->type('test1234','password')
        	->press('submit')
        	->seePageIs('/');
    }
}
