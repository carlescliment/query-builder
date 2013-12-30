<?php

namespace carlescliment\QueryBuilder;


class WhereClause
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
        return $this->entity . '=:' . $this->entity;
    }


    public function addQueryParameters($query)
    {
        $query->setParameter($this->entity, $this->value);
    }

}