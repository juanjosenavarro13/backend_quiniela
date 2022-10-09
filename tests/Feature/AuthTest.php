<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// constants
const URL = '/api/v1/auth/';
const PASSWORD = '123123';

class AuthTest extends TestCase
{


    /**
     * test method register and login
     */
    public function test_registerLoginMethod()
    {
        // method register
        $responsePost = $this->post(URL . 'register');
        $responseGet = $this->get(URL . 'register');
        $responsePut = $this->put(URL . 'register');
        $responseDel = $this->delete(URL . 'register');

        $responsePost->assertStatus(400);
        $responseGet->assertStatus(405);
        $responsePut->assertStatus(405);
        $responseDel->assertStatus(405);

        // method login
        $responsePost = $this->post(URL . 'login');
        $responseGet = $this->get(URL . 'login');
        $responsePut = $this->put(URL . 'login');
        $responseDel = $this->delete(URL . 'login');

        $responsePost->assertStatus(401);
        $responseGet->assertStatus(405);
        $responsePut->assertStatus(405);
        $responseDel->assertStatus(405);
    }


    /**
     * normal register and login success
     */
    public function test_registerSuccess()
    {
        // generate user
        $user = User::factory()->make()->toArray();
        $user['password'] = PASSWORD;
        $user['password_confirmation'] = PASSWORD;

        // register
        $responseRegister = $this->post(URL . 'register', $user);
        $responseRegister->assertStatus(200);

        // login
        $responseLogin = $this->post(URL . 'login', $user);
        $responseLogin->assertStatus(200);
    }


    /**
     * force register two times with identical email
     */
    public function test_registerDuplicateEmail()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = PASSWORD;
        $user['password_confirmation'] = PASSWORD;


        $response = $this->post(URL . 'register', $user);
        $response->assertStatus(200);

        $response = $this->post(URL . 'register', $user);
        $response->assertStatus(400);
    }
}
