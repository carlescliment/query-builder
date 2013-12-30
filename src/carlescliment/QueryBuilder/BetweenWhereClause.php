<?php

namespace carlescliment\QueryBuilder;


class BetweenWhereClause
{

    protected $entity;
    protected $start;
    protected $end;

    public function __construct($entity, $start, $end)
    {
        $this->entity = $entity;
        $this->start = $start;
        $this->end = $end;
    }

    public function __toString()
    {
        $references = $this->getValueReferences();
        return $this->entity . ' BETWEEN ' . implode(' AND ', $references);
    }


    public function addQueryParameters($query)
    {
        $references = $this->getValueReferences();
        $query->setParameter($this->entity . '_0', $this->start);
        $query->setParameter($this->entity . '_1', $this->end);
    }

    private function getValueReferences()
    {
        $entity = $this->entity;
        return array(':' . $entity . '_0', ':' . $entity . '_1');
    }
}