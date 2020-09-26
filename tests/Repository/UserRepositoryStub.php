<?php

namespace App\Tests;

use App\Entity\User;

class UserRepositoryStub
{
    public function find($id){

        $values = [
            [
              'id' => 0, 'name' => 'foo', 'email' => 'foo@gmail.com', 'roles' => 'admin', 'password' => '123456'
            ],[
              'id' => 1, 'name' => 'faa', 'email' => 'faa@gmail.com', 'roles' => 'admin', 'password' => '123456'
            ]
        ];

        if (array_key_exists($id, $values)) {
            return true;
        }

        return false;
    }
}
