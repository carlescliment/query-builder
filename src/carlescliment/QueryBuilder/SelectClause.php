<?php

namespace carlescliment\QueryBuilder;


class SelectClause
{
    private $text;
    private $count = false;

    public function __construct($select)
    {
        $this->text = $select;
    }

    public function __toString()
    {
        return 'SELECT ' . $this->text;
    }

    public function count($count_field)
    {
        $this->count = true;
        $this->text = 'COUNT(' . $count_field . ')';
    }

    public function isCount()
    {
        return $this->count;
    }
}