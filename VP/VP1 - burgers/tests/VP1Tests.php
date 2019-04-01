<?php

use PHPUnit\Framework\TestCase;

require('./../core/functions/functions.php');

class VP1Tests extends TestCase
{


    /**
     * Unit test for getting config
     */
    function testConfig()
    {
        $check = getConfig();
        self::assertArrayHasKey('db_host', $check, $check);
    }

    /**
 * Unit test for getting existing user
 */
    function testGetUser()
    {
        getConfig();
        $check = getUser('sdfsdf@sfsf.ghfh');
        self::assertArrayHasKey('email', $check);
    }
}