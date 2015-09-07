<?php

/*
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2015 vistart
 * @license http://vistart.name/license/
 */

namespace vistart\Helpers\models;

use yii\db\Connection;
/**
 * This BaseModel class is used for loading the configuration of database.
 *
 * @author vistart <i@vistart.name>
 */
class BaseModel extends \yii\db\ActiveRecord
{
    /**
     * Returns the database connection used by this AR class.
     * By default, the "db" application component is used as the database connection.
     * You may override this method if you want to use a different database connection.
     * @return Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        $config = require(__DIR__ . '/../config/region.php');
        return new Connection($config);
    }
}
