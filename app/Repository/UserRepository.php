<?php

namespace App\Repository;

use App\Entity\User;

/**
 * Class UserRepository
 * @package App\Repository
 */

class UserRepository {

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $id
     * @param Application $app
     */
    public function getById($id)
    {
        $statement = $this->pdo->prepare("SELECT id,username,password,created_at FROM users WHERE id = :id");

        $statement->execute([
            ':id' => $id
        ]);

        $result = $statement->fetch();

        return $this->hydrateUser($result);
    }

    public function getByUsername($username)
    {
        $statement = $this->pdo->prepare("SELECT id,username,password,created_at FROM users WHERE username = :username");

        $statement->execute([
            ':username' => $username
        ]);

        $result = $statement->fetch();

        return $this->hydrateUser($result);
    }

    /**
     * @param array $data
     */
    public function create(array $data = [])
    {
        return true;
    }

    /**
     * @param array $data
     * @return User
     */
    private function hydrateUser($data)
    {
        if($data == false) {
            return array();
        }

        return new User(
            $data->id,
            $data->username,
            $data->password,
            $data->created_at
        );
    }
} 