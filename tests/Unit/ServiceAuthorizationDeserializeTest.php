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
        $input = '*: FULL';
        $expectedResult = ['*' => Auth::PERM_FULL];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }

    public function test_single_line_multiple_entry()
    {
        $input = 'mcore.*:READ_ALL,hr.*:READ_OWN';
        $expectedResult = [
            'mcore.*' => Auth::PERM_READ_ALL,
            'hr.*'    => Auth::PERM_READ_OWN
        ];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }

    public function test_multiple_entry_with_whitespaces()
    {
        $input = '
            mcore.*: WRITE,
            project.*: READ_OWN,
            *: READ_OWN
        ';
        $expectedResult = [
            'mcore.*'   => Auth::PERM_WRITE_ALL,
            'project.*' => Auth::PERM_READ_OWN,
            '*'         => Auth::PERM_READ_OWN
        ];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }

    public function test_multiple_entry_irregular_case()
    {
        $input = '
            mcore.*: write,
            project.*: Write,
            *: Read
        ';
        $expectedResult = [
            'mcore.*'   => Auth::PERM_WRITE_ALL,
            'project.*' => Auth::PERM_WRITE_ALL,
            '*'         => Auth::PERM_READ_ALL
        ];

        $result = Auth::deserializePermission($input);
        $this->assertEquals($expectedResult, $result);
    }
}
