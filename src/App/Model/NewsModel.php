<?php

namespace App\Model;

use App\Core\Model;

class NewsModel extends Model
{
    const SHOW_BY_DEFAULT = 3;

    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function select()
    {
        $this->qb
            ->select('*')
            ->from('news')
            ->orderBy('pub_date', 'DESC')
            ->setMaxResults(2);

        $select = $this->qb->execute();

        $results = [];
        while ($row = $select->fetch()) {
            $results[] = $row;
        }

        return $results;
    }

    public function getNewsPerPage($page)
    {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $this->qb
            ->select('*')
            ->from('news')
            ->orderBy('pub_date', 'DESC')
            ->setFirstResult($offset)->setMaxResults($limit);

        $list = $this->qb->execute();

        $results = [];
        while ($row = $list->fetch()) {
            $results[] = $row;
        }

        return $results;
    }

    public function countNews()
    {
        $this->qb->select('*')->from('news');

        $total = $this->qb->execute();

        return $total->rowCount();

    }
}

