<?php

namespace Anddye\DateExpression;

use InvalidArgumentException;

class SqliteDateExpression extends DateExpression
{
    /**
     * Get the value of the expression.
     */
    public function getValue(): string
    {
        switch ($this->getUnit()) {
            case DateExpression::DAILY:
                return "strftime('%Y-%m-%d', datetime({$this->getWrappedColumn()}))";

            case DateExpression::WEEKLY:
                return "strftime('%Y-', datetime({$this->getWrappedColumn()})) || (strftime('%W', datetime({$this->getWrappedColumn()})) + (1 - strftime('%W', strftime('%Y', datetime({$this->getWrappedColumn()})) || '-01-04')))";

            case DateExpression::MONTHLY:
                return "strftime('%Y-%m', datetime({$this->getWrappedColumn()}))";

            default:
                throw new InvalidArgumentException('Unit not supported.');
        }
    }
}
