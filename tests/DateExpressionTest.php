<?php

namespace Anddye\DateExpression\Tests;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

abstract class DateExpressionTest extends TestCase
{
    protected function getQuery(): Builder
    {
        $model = new class() extends Model {};

        return $model->newQuery();
    }
}
