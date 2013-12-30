<?php

namespace carlescliment\QueryBuilder;


class QueryBuilder
{

    private $em;
    private $selectClause;
    private $fromClause;
    private $joins = array();
    private $wheres = array();
    private $orders = array();
    private $limit;
    private $offset;
    private $count;


    public function __construct(Database $em)
    {
        $this->em = $em;
    }


    public function select($select_clause)
    {
        $this->selectClause = new SelectClause($select_clause);
        return $this;
    }


    public function from($entity, $alias)
    {
        $this->fromClause = new FromClause($entity, $alias);
        return $this;
    }


    public function join($entity, $alias, $on, $join_type = 'JOIN')
    {
        $this->joins[] = new JoinClause($entity, $alias, $on, $join_type);
        return $this;
    }

    public function leftJoin($entity, $alias, $on)
    {
        return $this->join($entity, $alias, $on, 'LEFT JOIN');
    }


    public function where($entity, $value)
    {

        $this->wheres[] = WhereClauseFactory::build($entity, $value);
        return $this;
    }


    /** Alias for where */
    public function andWhere($entity, $value)
    {
        return $this->where($entity, $value);
    }


    public function orderBy($field, $order = 'DESC')
    {
        $this->orders[] = new OrderByClause($field, $order);
        return $this;
    }


    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }


    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }


    public function count($count_field)
    {
        $this->selectClause->count($count_field);
        return $this;
    }


    public function execute()
    {
        $query_str = $this->buildQueryString();
        $query = $this->em->createQuery($query_str);
        $this->setQueryParameters($query);
        if ($this->limit) {
            $query->setMaxResults($this->limit);
        }
        if ($this->offset) {
            $query->setFirstResult($this->offset);
        }
        return $this->selectClause->isCount() ? $query->getSingleScalarResult() : $query->getResult();
    }


    private function buildQueryString()
    {
        $query = "$this->selectClause $this->fromClause";
        $query .= $this->joinsToString();
        $query .= $this->wheresToString();
        $query .= $this->orderByToString();
        return $query;
    }


    private function joinsToString()
    {
        return empty($this->joins) ? '' : ' ' . implode(' ', $this->joins);
    }


    private function wheresToString()
    {
        return empty($this->wheres) ? '' : ' WHERE ' . implode(' AND ', $this->wheres);
    }


    private function orderByToString()
    {
        return empty($this->orders) ? '' : ' ORDER BY ' . implode(', ', $this->orders);
    }


    private function setQueryParameters($query)
    {
        foreach ($this->wheres as $where) {
            $where->addQueryParameters($query);
        }
    }

}