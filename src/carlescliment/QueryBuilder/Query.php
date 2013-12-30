<?php

namespace carlescliment\QueryBuilder;


abstract class Query
{

	private $query;
	private $parameters = array();

	public function __construct($query_str) {
		$this->query = $query_str;
	}

	public function setParameter($key, $value) {
		$this->query = str_replace(':'.$key, $value, $this->query);
	}

	public abstract function getResult();

	public abstract function setMaxResults();

	public abstract function setFirstResult();

	public abstract function getSingleScalarResult();
}