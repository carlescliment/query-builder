<?php

namespace carlescliment\QueryBuilder;


abstract class ComparisonWhereClause
{

    protected $entity;
    protected $value;


    public function __construct($entity, $value)
    {
        $this->entity = $entity;
        $this->value = $value;
    }


    protected abstract function getSymbol();


    public function __toString()
    {
        $symbol = $this->getSymbol();
        return $this->entity . " $symbol :" . $this->entity;
    }


    public function addQueryParameters($query)
    {
        $query->setParameter($this->entity, $this->value);
    }
}