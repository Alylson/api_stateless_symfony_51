<?php

namespace App\Service;

use App\Entity\ResetPasswordRequest;
use App\Entity\User;
use App\Repository\ResetPasswordRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\TooManyPasswordRequestsException;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class ResetPasswordService
{
    use ResetPasswordControllerTrait;

    private $userRepository;
    private $mailer;
    private $entityManager;
    private $resetPasswordHelper;

    public function __construct(UserRepository $userRepository, MailerInterface $mailer, EntityManagerInterface $entityManager, ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    public function sendEmail($request)
    {
        $transformRequest = new RequestResponseService();
        $value = $transformRequest->transformRequest($request);
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $value->request->get('email'),
        ]);

        if(!$user) {
            return [
                'status' => 400,
                'success' => "Solicitação inválida",
            ];
        }

        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
        }

        $email = (new Email())
            ->from('carneiroalylson@gmail.com')
            ->to($value->request->get('email'))
            ->subject('Solicitação de recuperação de senha')
            ->html("<p>Para alterar a senha clique no link ou copie e cole no seu navegador favorito: </p>");

        $this->mailer->send($email);
/*
        if($response == false) {
            var_dump('1');
        }*/

        return [
            'status' => 200,
            'success' => "Email enviado com sucesso",
        ];
    }

    public function reset($request, $passwordEncoder, string $token = null)
    {

    }


}
