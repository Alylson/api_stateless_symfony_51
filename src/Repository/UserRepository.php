<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $email
     * @return void
     */
    public function getEmail($email)
    {
        $userEmail = $this->createQueryBuilder('u')
            ->select('u.email')
            ->where('u.email = :email')
            ->setParameter('email',$email)
            ->getQuery()
            ->getResult();

        if (!$userEmail[0]['email']) {
            return false;
        }

        return true;
    }
}
