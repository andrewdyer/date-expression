<h1 align="center">Date Expression</h1>

<p align="center">A utility that can be used to create raw query date expressions for MySQL or SQLite Laravel databases.</p>

<p align="center">
    <a href="https://packagist.org/packages/andrewdyer/date-expression"><img src="https://poser.pugx.org/andrewdyer/date-expression/downloads?style=for-the-badge" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/andrewdyer/date-expression"><img src="https://poser.pugx.org/andrewdyer/date-expression/v?style=for-the-badge" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/andrewdyer/date-expression"><img src="https://poser.pugx.org/andrewdyer/date-expression/license?style=for-the-badge" alt="License"></a>
</p>

## License
Licensed under MIT. Totally free for private or commercial projects.

## Installation
```text
composer require andrewdyer/date-expression
```

## Usage
```php
use Anddye\DateExpression\DateExpressionFactory;

$dateExpression = DateExpressionFactory::create($query, $column, $unit);

$value = $dateExpression->getValue();
```
### Function Arguments
| Name    | Type                                 | Description                                                                       |
|---------|--------------------------------------|-----------------------------------------------------------------------------------|
| $query  | Illuminate\Database\Eloquent\Builder | The query builder being used to build the trend.                                  |
| $column | string                               | The column being measured.                                                        |
| $unit   | string                               | The unit being measured. Supported values include; "daily", "monthly" or "weekly" |

## Support
If you're using this package, I'd love to hear your thoughts! Feel free to contact me on [Twitter](https://twitter.com/andyer92).

Found a bug? Please report it using the [issue tracker](https://github.com/andrewdyer/date-expression/issues), or better yet, fork the repository and submit a pull request.