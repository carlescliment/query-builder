<?php

namespace carlescliment\QueryBuilder;


class LikeWhereClause
{

    protected $entity;
    protected $value;

    public function __construct($entity, $value)
    {
        $this->entity = $entity;
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->entity . ' LIKE :' . $this->entity;
    }


    public function addQueryParameters($query)
    {
        $query->setParameter($this->entity, $this->value);
    }
}