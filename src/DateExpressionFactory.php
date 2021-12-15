<?php

namespace Anddye\DateExpression;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use InvalidArgumentException;

class DateExpressionFactory
{
    public static function create(Builder $query, string $column, string $unit): Expression
    {
        $driver = $query->getConnection()->getDriverName();

        switch ($driver) {
            case 'mysql':
                return new MySqlDateExpression($query, $column, $unit);

            case 'sqlite':
                return new SqliteDateExpression($query, $column, $unit);

            default:
                throw new InvalidArgumentException('Driver not supported.');
        }
    }
}
