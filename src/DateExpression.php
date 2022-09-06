<?php

namespace Anddye\DateExpression;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

abstract class DateExpression extends Expression
{
    public const DAILY = 'daily';
    public const MONTHLY = 'monthly';
    public const WEEKLY = 'weekly';

    /**
     * The column.
     */
    private $column;

    /**
     * The query builder.
     */
    private $query;

    /**
     * The unit.
     */
    private $unit;

    /**
     * Create a new raw query expression.
     */
    public function __construct(Builder $query, string $column, string $unit)
    {
        $this->unit = $unit;
        $this->query = $query;
        $this->column = $column;
    }

    /**
     * Get the column.
     */
    protected function getColumn(): string
    {
        return $this->column;
    }

    /**
     * Get the query builder.
     */
    protected function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * Get the unit.
     */
    protected function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Wrap the given value using the query's grammar.
     */
    protected function getWrappedColumn(): string
    {
        return $this->getQuery()->getQuery()->getGrammar()->wrap($this->getColumn());
    }
}
