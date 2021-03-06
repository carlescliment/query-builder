<?php

namespace carlescliment\QueryBuilder;


class WhereClauseFactory
{

    public static function build($entity, $value)
    {
        if (preg_match('/in\((.*)\)/', $value, $matches)) {
            $values = explode(',', $matches[1]);
            return new InWhereClause($entity, $values);
        }
        if (preg_match('/between\((.+,.+)\)/', $value, $matches)) {
            $values = explode(',', $matches[1]);
            return new BetweenWhereClause($entity, $values[0], $values[1]);
        }
        if (preg_match('/like\((.*)\)/', $value, $matches)) {
            return new LikeWhereClause($entity, $matches[1]);
        }
        if (preg_match('/lt\((.*)\)/', $value, $matches)) {
            return new LowerThanWhereClause($entity, $matches[1]);
        }
        if (preg_match('/gt\((.*)\)/', $value, $matches)) {
            return new GreaterThanWhereClause($entity, $matches[1]);
        }
        if (preg_match('/leqt\((.*)\)/', $value, $matches)) {
            return new LowerThanWhereClause($entity, $matches[1], false);
        }
        if (preg_match('/geqt\((.*)\)/', $value, $matches)) {
            return new GreaterThanWhereClause($entity, $matches[1], false);
        }
        return new WhereClause($entity, $value);
    }
}
