<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function create_default_user()
    {
        create_default_user();
        $this->assertDabaseCount('users',1);
        $this->assertDatabaseHas('users',[
            'email'=> config('casteaching.default.user.email'),
        ]);
        $this->assertDatabaseHas('users',[
            'name'=> config('casteaching.default.user.name'),
        ]);

        $user = User::find(1);
        $this->assertNotNull($user);
        $this->assertEquals(config('casteaching.default_user.email'), $user->email);
        $this->assertEquals(config('casteaching.default_user.name'), $user->name);

        $this->assertTrue(Hash::check(config('casteaching.default_user.name'), $user->password));

    }
}
