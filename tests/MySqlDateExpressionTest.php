<?php

namespace Anddye\DateExpression\Tests;

use Anddye\DateExpression\DateExpression;
use Anddye\DateExpression\DateExpressionFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

final class MySqlDateExpressionTest extends DateExpressionTest
{
    public static function setUpBeforeClass(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => getenv('MYSQL_HOST'),
            'port' => getenv('MYSQL_PORT'),
            'database' => getenv('MYSQL_DATABASE'),
            'username' => getenv('MYSQL_USERNAME'),
            'password' => getenv('MYSQL_PASSWORD'),
            'charset' => getenv('MYSQL_CHARSET'),
            'collation' => getenv('MYSQL_COLLATION'),
            'prefix' => getenv('MYSQL_PREFIX'),
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function testCreatesDailyExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::DAILY;

        $expectedExpression = "date_format(`created_at`, '%Y-%m-%d')";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }

    public function testCreatesMonthlyExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::MONTHLY;

        $expectedExpression = "date_format(`created_at`, '%Y-%m')";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }

    public function testCreatesWeekExpression(): void
    {
        $query = $this->getQuery();
        $column = 'created_at';
        $unit = DateExpression::WEEKLY;

        $expectedExpression = "date_format(`created_at`, '%x-%v')";
        $actualExpression = DateExpressionFactory::create($query, $column, $unit);

        $this->assertEquals($expectedExpression, $actualExpression);
    }
}
