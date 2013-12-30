<?php

namespace carlescliment\QueryBuilder;


class OrderByClause
{
    private $field;
    private $order;

    public function __construct($field, $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    public function __toString()
    {
        return $this->field . ' ' . $this->order;
    }
}