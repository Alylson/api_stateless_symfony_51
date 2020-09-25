<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Validator\NotEmptyValidator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $userRepository;
    private $entityManager;
    private $encoder;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }

    public function getAllUser()
    {
        return $this->userRepository->findAll();
    }

    public function addUser($request)
    {
        try{
            $request = $this->transformJsonBody($request);

            $notEmptyValidator = new NotEmptyValidator($request->get('name'), $request->get('email'), $request->request->get('roles'), $request->request->get('password'));
            $value = $notEmptyValidator->isValid();

            if($value == false) {
                throw new \Exception();
            }

            $user = new User();
            $user->setName($request->get('name'));
            $user->setEmail($request->get('email'));
            $user->setRoles([$request->get('roles')]);
            $user->setPassword($this->encoder->encodePassword($user, $request->get('password')));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }catch (\Exception $e){
            return [
                'status' => 422,
                'errors' => "Dados inválidos",
            ];
        }

        return [
            'status' => 200,
            'success' => "Usuário adicionado com sucesso",
        ];
    }

    public function getUser($id)
    {
        try {
            $data = $this->userRepository->find($id);
        } catch (\Exception $e) {
            return [
                'status' => 404,
                'errors' => "Usuário não encontrado",
            ];
        }

        return $data;
    }

    public function updateUser($request, $id)
    {
        try{
            $user = $this->userRepository->find($id);

            if (!$user){
                return [
                    'status' => 404,
                    'errors' => "Usuário não encontrado",
                ];
            }

            $request = $this->transformJsonBody($request);

            /*if (!$request || !$request->request->get('name') || !$request->request->get('email') || !$request->get('roles') || !$request->request->get('password')){
                throw new \Exception();
            }*/
            $notEmptyValidator = new NotEmptyValidator($request->get('name'), $request->get('email'), $request->request->get('roles'), $request->request->get('password'));
            $value = $notEmptyValidator->isValid();

            if($value == false) {
                throw new \Exception();
            }

            $user->setName($request->get('name'));
            $user->setEmail($request->get('email'));
            $user->setRoles([$request->get('roles')]);
            $user->setPassword($this->encoder->encodePassword($user, $request->get('password')));
            $this->entityManager->flush();

        }catch (\Exception $e){
            return [
                'status' => 422,
                'errors' => "Dados inválidos",
            ];
        }

        return [
            'status' => 200,
            'errors' => "Usuário atualizado com sucesso",
        ];
    }

    public function delUser($id)
    {
        try {
            $user = $this->userRepository->find($id);

            if (!$user){
                throw new \Exception();
            }

            $this->entityManager->remove($user);
            $this->entityManager->flush();

        } catch (\Exception $e) {
            return [
                'status' => 404,
                'errors' => "Usuário não encontrado",
            ];
        }

        return [
            'status' => 200,
            'errors' => "Usuário excluído com sucesso",
        ];
    }

    /**
     * @param Request $request
     * @return Request
     */
    protected function transformJsonBody(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
