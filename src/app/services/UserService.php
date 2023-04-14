<?php

namespace App\services;

use App\entities\User;
use App\QueryBuilder;
use Aura\SqlQuery\Exception;
use function Tamtamchik\SimpleFlash\flash;

class UserService
{
    private QueryBuilder $queryBuilder;

    /**
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getAllUser(string $orderBy = 'id DESC'): array
    {
        $users = [];

        $usersFetch = $this->queryBuilder->getAll('users', $orderBy);
        foreach ($usersFetch as $user){
            $users[] = new User(
                $user['id'],
                $user['username'],
                $user['email'],
                $user['roles_mask'],
                (bool)$user['status'],
                (bool)$user['verified'],
                (bool)$user['resettable']);
        }

        return $users;
    }
}