<?php

namespace App\Tests;

use App\Entity\User;
use App\tests\UserRepositoryStub;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
#use App\Service\UserService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserServiceTest extends TestCase
{
    /**
     * @test
     * @param EntityManagerInterface $entityManager
     */
    public function addUser($entityManager)
    {

        $user = new User();
        $user->setName('foo');
        $user->setEmail('foo@gmail.com');
        $user->setRoles(['admin']);
        $user->setPassword(base64_encode('123456'));
        $entityManager->persist($user);
        $entityManager->flush();

        $this->assertEquals(true, $user);
    }

    /**
     * @test
     * @param UserRepositoryStub $userRepositoryStub
     * @param $id
     * @return array
     */
    public function getUser($id, $userRepositoryStub)
    {
        try {
            $data = $userRepositoryStub->find($id);
        } catch (\Exception $e) {
            return [
                'status' => 404,
                'errors' => "Usuário não encontrado",
            ];
        }

        $this->assertEquals(true, $data);
    }
}
