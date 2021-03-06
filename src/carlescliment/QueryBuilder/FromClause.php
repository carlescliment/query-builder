<?php

namespace carlescliment\QueryBuilder;


class FromClause
{
    private $entity;
    private $alias;

    public function __construct($entity, $alias)
    {
        $this->entity = $entity;
        $this->alias = $alias;
    }

    public function __toString()
    {
        return 'FROM ' . $this->entity . ' ' . $this->alias;
    }
}