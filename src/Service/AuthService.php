<?php

namespace App\Service;

use App\Document\ResetPassword;

class AuthService
{
    /**
     * @param $documentManager
     * @param $userName
     * @param $token
     * @param $date
     * @return void
     */
    public function persistMongo($documentManager, $userName, $token, $date)
    {
        $user = new ResetPassword();
        $user->setSelector($userName);
        $user->setHashedToken($token);
        $user->setRequestedAt($date);

        $documentManager->persist($user);
        $documentManager->flush();
    }
}
