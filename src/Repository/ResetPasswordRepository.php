<?php

namespace App\Repository;

use App\Document\ResetPassword;
#use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * @method ResetPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetPassword[]    findAll()
 * @method ResetPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetPasswordRepository extends DocumentRepository
{

}
