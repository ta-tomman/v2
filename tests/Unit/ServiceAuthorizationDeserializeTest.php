<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Service\Auth;

class ServiceAuthorizationDeserializeTest extends TestCase
{
    public function test_empty_string_returns_empty_array()
    {
        $input = '';
        $expectedResult = [];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }

    public function test_single_entry()
    {
        $input = "['*':'FULL']";

        $expectedResult = ['*' => Auth::PERM_FULL];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }
}
