<?php

namespace Anddye\DateExpression\Tests;

use Anddye\DateExpression\DateExpression;
use Anddye\DateExpression\DateExpressionFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

final class SqliteDateExpressionTest extends DateExpressionTest
{
    public static function setUpBeforeClass(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function testCreatesDailyExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::DAILY;

        $expectedExpression = "strftime('%Y-%m-%d', datetime(\"created_at\"))";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }

    public function testCreatesMonthlyExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::MONTHLY;

        $expectedExpression = "strftime('%Y-%m', datetime(\"created_at\"))";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }

    public function testCreatesWeeklyExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::WEEKLY;

        $expectedExpression = "strftime('%Y-', datetime(\"created_at\")) || (strftime('%W', datetime(\"created_at\")) + (1 - strftime('%W', strftime('%Y', datetime(\"created_at\")) || '-01-04')))";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }
}
