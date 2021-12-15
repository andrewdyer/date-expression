<?php

namespace Anddye\DateExpression;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

abstract class DateExpression extends Expression
{
    public const DAILY = 'daily';
    public const MONTHLY = 'monthly';
    public const WEEKLY = 'weekly';

    private $column;
    private $query;
    private $unit;

    public function __construct(Builder $query, string $column, string $unit)
    {
        $this->unit = $unit;
        $this->query = $query;
        $this->column = $column;
    }

    protected function getColumn(): string
    {
        return $this->column;
    }

    protected function getQuery(): Builder
    {
        return $this->query;
    }

    protected function getUnit(): string
    {
        return $this->unit;
    }

    protected function getWrappedColumn(): string
    {
        return $this->getQuery()->getQuery()->getGrammar()->wrap($this->getColumn());
    }
}
