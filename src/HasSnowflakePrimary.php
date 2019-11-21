<?php
namespace Kra8\Snowflake;

use Kra8\Snowflake\Snowflake;

trait HasSnowflakePrimary
{
    public static function bootHasSnowflakePrimary()
    {
        static::saving(function ($model) {
            $model->setIncrementing(false);
            if (is_null($model->getKey())) {
                $keyName    = $model->getKeyName();
                $id         = app(Snowflake::class)->next();
                $model->setAttribute($keyName, $id);
            }
        });
    }
}
