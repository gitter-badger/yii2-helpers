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

namespace vistart\Helpers;

use Yii;
use yii\db\Connection;
use vistart\Helpers\models\Setting;
/**
 * Description of BaseGeolocation
 *
 * @author vistart
 */
class BaseGeolocation {
    protected $db;
    public function __construct($config = null)
    {
        if (!$config) {
            $config = require(__DIR__ . '/config/region.php');
        }
        $this->db = new Connection($config);
    }
    
    public function getDb()
    {
        return $this->db;
    }
    
    public static function version()
    {
        return Setting::findOne(['key' => 'version'])['value'];
    }
}
