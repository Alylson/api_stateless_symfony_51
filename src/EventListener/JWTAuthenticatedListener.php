<?php

namespace App\EventListener;

use App\Document\ResetPassword;
use App\Entity\User;
use App\Service\AuthService;
use Doctrine\ODM\MongoDB\DocumentManager;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;

class JWTAuthenticatedListener extends JWTUserToken
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * @param JWTAuthenticatedEvent $event
     * @return void
     * @throws Exception
     */
    public function onJWTAuthenticated(JWTAuthenticatedEvent $event)
    {
        $data = $event->getToken();

        $userName = $data->getUsername();
        $token = $data->getCredentials();
        $dateTime = new \DateTime();
        $date = $dateTime->format('yy-m-d');

        $authService = new AuthService();
        $authService->persistMongo($this->documentManager, $userName, $token, $date);
    }
}