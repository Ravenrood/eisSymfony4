<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 23.03.2019
 * Time: 18:53
 */

namespace App\Command;


interface CommandInterface
{
    const CONSOLE_COMMAND_LOCKED = 'Command is currently Locked';
    const RANDOM_USER_DESCRIPTION = 'list the users';
    const RANDOM_USER_FORMAT_DESCRIPTION = 'Format output as a table';
    const TABLE_HEADER_FIRST_NAME = 'First Name';
    const TABLE_HEADER_LAST_NAME = 'Last Name';
    const TABLE_HEADER_ADDRESS = 'Address';
}