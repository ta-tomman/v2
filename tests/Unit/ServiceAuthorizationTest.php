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
                Auth::PERM_READ_ALL,
                ['auth.user' => Auth::PERM_READ_ALL]
            )
        );
    }

    public function test_wildcard_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user',
                Auth::PERM_READ_ALL,
                ['auth.*' => Auth::PERM_READ_ALL]
            )
        );
    }

    public function test_higher_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user',
                Auth::PERM_READ_OWN,
                ['auth.*' => Auth::PERM_READ_ALL]
            )
        );
    }

    public function test_higher_module()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'auth.user.update',
                Auth::PERM_WRITE_OWN,
                ['auth.*' => Auth::PERM_WRITE_ALL]
            )
        );
    }

    public function test_multiple_available_permission()
    {
        $this->assertTrue(
            Auth::hasPermission(
                'hr.list',
                Auth::PERM_READ_ALL,
                [
                    'auth.*' => Auth::PERM_WRITE_ALL,
                    'hr.*' => Auth::PERM_READ_ALL
                ]
            )
        );
    }
}
