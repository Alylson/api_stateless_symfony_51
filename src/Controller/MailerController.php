<?php

namespace App\Controller;

use App\Service\EmailService;
use App\Service\RequestResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @Route("/email", name="send_email", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws TransportExceptionInterface
     */
    public function sendEmail(Request $request)
    {
        $sendEmail = $this->emailService->sendEmail($request);

        return $this->json($sendEmail);
    }
}