<?php

namespace carlescliment\QueryBuilder;


interface Database
{
	public function createQuery($query_string);
}
