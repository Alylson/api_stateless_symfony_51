<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Service\RequestResponseService;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $userRepository;
    private $mailer;

    public function __construct(UserRepository $userRepository, MailerInterface $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    /**
     * @param $request
     * @return array
     * @throws TransportExceptionInterface
     */
    public function sendEmail($request)
    {
        try {
            $transformRequest = new RequestResponseService();
            $value = $transformRequest->transformRequest($request);

            $user = $this->userRepository->getEmail($value->request->get('email'));

            if($user == false) {
                throw new \Exception();
            }

            $email = (new Email())
                ->from('carneiroalylson@gmail.com')
                ->to($value->request->get('email'))
                ->subject('Solicitação de recuperação de senha')
                ->html('<p>Para alterar a senha clique no link ou copie e cole no seu navegador favorito: </p>');

            $this->mailer->send($email);
        } catch (\Exception $e){
            return [
                'status' => 422,
                'errors' => "Erro no envio",
            ];
        }

        return [
            'status' => 200,
            'success' => "Email enviado com sucesso",
        ];
    }
}
