<?php

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Model
{
    protected $qb;

    public function __construct(Connection $connection)
    {
        $this->qb = new QueryBuilder($connection);
    }
}