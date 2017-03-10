<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Service\Auth;

class ServiceAuthorizationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_exact_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user',
                Auth::PERM['READ_ALL'],
                ['auth.user' => Auth::PERM['READ_ALL']]
            )
        );
    }

    public function test_wildcard_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user',
                Auth::PERM['READ_ALL'],
                ['auth.*' => Auth::PERM['READ_ALL']]
            )
        );
    }

    public function test_higher_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user',
                Auth::PERM['READ_OWN'],
                ['auth.*' => Auth::PERM['READ_ALL']]
            )
        );
    }

    public function test_higher_module()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user.update',
                Auth::PERM['WRITE_OWN'],
                ['auth.*' => Auth::PERM['WRITE_ALL']]
            )
        );
    }

    public function test_multiple_available_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'hr.list',
                Auth::PERM['READ_ALL'],
                [
                    'auth.*' => Auth::PERM['WRITE_ALL'],
                    'hr.*' => Auth::PERM['READ_ALL']
                ]
            )
        );
    }
}
