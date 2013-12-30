<?php

namespace carlescliment\QueryBuilder;


class LowerThanWhereClause
{

    protected $entity;
    protected $value;
    protected $equality;

    public function __construct($entity, $value, $equality = false)
    {
        $this->entity = $entity;
        $this->value = $value;
        $this->equality = $equality;
    }

    public function __toString()
    {
        $symbol = $this->equality ? '<=' : '<';
        return $this->entity . " $symbol :" . $this->entity;
    }


    public function addQueryParameters($query)
    {
        $query->setParameter($this->entity, $this->value);
    }
}