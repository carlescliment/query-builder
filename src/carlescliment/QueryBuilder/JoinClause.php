<?php

namespace carlescliment\QueryBuilder;


class JoinClause
{
    private $entity;
    private $alias;
    private $type;
    private $on;

    public function __construct($entity, $alias, $on, $type)
    {
        $this->entity = $entity;
        $this->alias = $alias;
        $this->on = $on;
        $this->type = $type;
    }

    public function __toString()
    {
        return $this->type . ' ' . $this->entity . ' ' . $this->alias . ' ON ' . $this->on;
    }
}