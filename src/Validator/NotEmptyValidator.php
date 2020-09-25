<?php

namespace App\Validator;

class NotEmptyValidator
{
    private $name;
    private $email;
    private $roles;
    private $password;

    public function __construct($name, $email, $roles, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
    }

    public function isValid()
    {
        if(!$this->name || !$this->email || !$this->roles || !$this->password)
        {
            return false;
        }
        return true;
    }
}
