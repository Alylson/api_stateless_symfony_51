<?php

namespace App\Tests\Service;

use App\Document\ResetPassword;
use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    public function persistMongo($documentManager, $userName, $token, $date)
    {
        $user = new ResetPassword();
        $user->setSelector($userName);
        $user->setHashedToken($token);
        $user->setRequestedAt($date);

    }
}
