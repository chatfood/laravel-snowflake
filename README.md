# Laravel Snowflake
[![Build Status](https://travis-ci.org/kra8/laravel-snowflake.svg?branch=setup-travis)](https://travis-ci.org/kra8/laravel-snowflake)
[![Latest Stable Version](https://poser.pugx.org/kra8/laravel-snowflake/v/stable)](https://packagist.org/packages/kra8/laravel-snowflake)
[![License](https://poser.pugx.org/kra8/laravel-snowflake/license)](https://packagist.org/packages/kra8/laravel-snowflake)

This Laravel package to generate 64 bit identifier like the snowflake within Twitter.

# Laravel Installation
```
composer require "kra8/laravel-snowflake"

php artisan vendor:publish --provider="Kra8\Snowflake\Providers\LaravelServiceProvider"
```

# Lumen Installation
- Install via composer
```
composer require "kra8/laravel-snowflake"
```

- Bootstrap file changes
Add the following snippet to the bootstrap/app.php file under the providers section as follows:
``` php
// Add this line
$app->register(Kra8\Snowflake\Providers\LumenServiceProvider::class);
```

# Usage
Get instance
``` php
$snowflake = $this->app->make('Kra8\Snowflake\Snowflake');
```
or
``` php
$snowflake = app('Kra8\Snowflake\Snowflake');
```

Generate snowflake identifier
```
$id = $snowflake->next();
```
# Usage with Eloquent
Add the `Kra8\Snowflake\HasSnowflakePrimary` trait to your Eloquent model.
This trait make type `snowflake` of primary key.  Don't forget to set the Auto increment property to false.

``` php
<?php
namespace App;

use Kra8\Snowflake\HasSnowflakePrimary;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasSnowflakePrimary, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
```

Finally, in migrations, set the primary key to `bigInteger`, `unsigned` and `primary`.

``` php
/**
 * Run the migrations.
 *
 * @return void
 */
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        // $table->increments('id');
        $table->bigInteger('id')->unsigned()->primary();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```


# Configuration
If `config/snowflake.php` not exist, run below:
```
php artisan vendor:publish
```

# Licence
[MIT licence](https://github.com/kra8/laravel-snowflake/blob/master/LICENSE)
