<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\SanctumTouse Illuminate\Foundation\Testing\WithFaker;
kenController
 */

class SanctumTokenControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function email_is_required_for_issuing_tokens()
    {

        //Exec
        $response = $this->postJson('/api/sanctum/token',[
            'password'=> '1234578',
            'device_name'=> "Pepe's device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());

        $this->assertEquals("The given data was invalid.", $jsonResponse->message);
        $this->assertEquals("The email field is required.", $jsonResponse->errors->email[0]);

    }

    /** @test */
    public function email_is_valid_for_issuing_tokens()
    {
        // Execució
        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'notvalidemail',
            'password' => '12345678',
            'device_name' => "Pepe's device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The given data was invalid.",$jsonResponse->message);
        $this->assertEquals("The provided credential are incorrect",$jsonResponse->errors->email[0]);
    }

    /** @test */
    public function password_is_required_for_issuing_tokens()
    {
        // Execució
        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'sergiturbadenas@gmail.com',
            'device_name' => "Pepe's device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The given data was invalid.",$jsonResponse->message);
        $this->assertEquals("The password field is required.",$jsonResponse->errors->password[0]);
    }

    /** @test */
    public function device_name_is_required_for_issuing_tokens()
    {
        // Execució
        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'sergiturbadenas@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The given data was invalid.",$jsonResponse->message);
        $this->assertEquals("The device name field is required.",$jsonResponse->errors->device_name[0]);
    }


    public function invalid_password_gives_incorrect_credentials_error()
    {
        // Preparació
        $user = User::create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepe@pardojeans.com',
            'password' => '12345678'
        ]);

        // Execució
        $response = $this->postJson('/api/sanctum/token',[
            'email' => $user->email,
            'password' => 'INCORRECT_PASSWORD',
            'device_name' => $user->name . "'s device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The given data was invalid.",$jsonResponse->message);
        $this->assertEquals("The provided credentials are incorrect.",$jsonResponse->errors->email[0]);
    }



    /** @test */
    public function invalid_email_gives_incorrect_credentials_error()
    {
        //Prep
        $user = User::create([
            'name'=> 'Pepe Pardo Jeans',
            'email'=> 'pepe@pardojeans',
            'password'=> '12345678'
        ]);

        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'another_email',
            'password'=> $user->password,
            'device_name'=> $user->name . "'s device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The given data was invalid.", $jsonResponse->message);
        $this->assertEquals("The provided credential are incorrect", $jsonResponse->errors->email[0]);

    }


    /** @test */
    public function users_with_valid_credentials_can_issue_a_token()
    {
        //Prep
        $user = User::create([
            'name'=> 'Pepe Pardo Jeans',
            'email'=> 'pepe@pardojeans',
            'password'=> '12345678'
        ]);

        $this->assertCount(0,$user->tokens);
        //Exec
        $response = $this->postJson('/api/sanctum/token',[
            'email' => $user->email,
            'password'=> $user->password,
            'device_name'=> $user->name . "'s device",
        ]);

        //Comprov

        $response->assertStatus(200);
        $this->assertNotNull($response->getContent());
        $this->assertCount(1,$user->fresh()->tokens);
    }


}
