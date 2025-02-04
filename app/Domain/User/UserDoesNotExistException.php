<?php

namespace App\Domain\User;

use Exception;

class UserDoesNotExistException extends Exception
{
    protected $message = 'User does not exist';
}
