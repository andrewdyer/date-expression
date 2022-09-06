<?php

namespace Anddye\DateExpression;

use InvalidArgumentException;

class MySqlDateExpression extends DateExpression
{
    /**
     * Get the value of the expression.
     */
    public function getValue(): string
    {
        switch ($this->getUnit()) {
            case DateExpression::DAILY:
                return "date_format({$this->getWrappedColumn()}, '%Y-%m-%d')";

            case DateExpression::WEEKLY:
                return "date_format({$this->getWrappedColumn()}, '%x-%v')";

            case DateExpression::MONTHLY:
                return "date_format({$this->getWrappedColumn()}, '%Y-%m')";

            default:
                throw new InvalidArgumentException('Unit not supported.');
        }
    }
}
