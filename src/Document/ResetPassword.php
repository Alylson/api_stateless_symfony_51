<?php

namespace App\Document;

use App\Repository\ResetPasswordRequestRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @MongoDB\Document(repositoryClass=ResetPasswordRequestRepository::class)
 */
class ResetPassword
{
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\Field(type="int")
     */
    private $user_id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $selector;

    /**
     * @MongoDB\Field(type="string")
     */
    private $hashed_token;

    /**
     * @MongoDB\Field(type="date")
     */
    private $requested_at;

    /**
     * @MongoDB\Field(type="date")
     */
    private $expires_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @param mixed $selector
     */
    public function setSelector($selector): void
    {
        $this->selector = $selector;
    }

    /**
     * @return mixed
     */
    public function getHashedToken()
    {
        return $this->hashed_token;
    }

    /**
     * @param mixed $hashed_token
     */
    public function setHashedToken($hashed_token): void
    {
        $this->hashed_token = $hashed_token;
    }

    /**
     * @return mixed
     */
    public function getRequestedAt()
    {
        return $this->requested_at;
    }

    /**
     * @param mixed $requested_at
     */
    public function setRequestedAt($requested_at): void
    {
        $this->requested_at = $requested_at;
    }

    /**
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @param mixed $expires_at
     */
    public function setExpiresAt($expires_at): void
    {
        $this->expires_at = $expires_at;
    }
}
