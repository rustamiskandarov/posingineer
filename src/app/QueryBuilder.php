<?php

namespace App;

use App\exceptions\ElementNotFoundException;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder
{
    private PDO $pdo;
    private QueryFactory $queryFactory;


    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }


    public function getAll(string $table, string $groupBy = 'id DESC', array $fields = ['*'])
    {

        $select = $this->queryFactory->newSelect();
        $select->cols($fields)->from($table)->groupBy([$groupBy]);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * @throws ElementNotFoundException
     */
    public function getOne(string $table, int $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)->where('id =:id')
            ->bindValue('id',$id)
        ;

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$result){
            throw new ElementNotFoundException('Элемент с id '.$id. ' не найден!');
        }

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function create(string $table, array $cols)
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)                   // INTO this table
            ->cols($cols)// raw value as "(ts) VALUES (NOW())"
            ->bindValues($cols);

        $sth = $this->pdo->prepare($insert->getStatement());
        try {
            $sth->execute($insert->getBindValues());
            $name = $insert->getLastInsertIdName('id');
            return $this->pdo->lastInsertId($name);
        }catch (\PDOException $exception){
            var_dump($exception->getMessage());
        }

    }

    public function update(string $table, array $cols, int $id): bool
    {
        $update = $this->queryFactory->newUpdate();
        $update
            ->table($table)
            ->cols($cols)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($update->getStatement());

        try {
            $sth->execute($update->getBindValues());
        } catch (\PDOException $exception){
            var_dump($exception->getMessage());
            return false;
        }

        return true;

    }

    public function delete(string $table, int $id)
    {
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($delete->getStatement());

        return $sth->execute($delete->getBindValues());
    }

}