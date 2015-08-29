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
use vistart\Helpers\models\Country;
use vistart\Helpers\models\Province;
use vistart\Helpers\models\City;
use vistart\Helpers\models\District;
/**
 * Description of BaseGeolocation
 *
 * @author vistart <i@vistart.name>
 */
class BaseGeolocation 
{
    /**
     * 
     * @var Connection 
     */
    protected $db;
    
    /**
     * Construct new database connection.
     * @param mixed|null $config the database's configuration.
     */
    public function __construct($config = null)
    {
        if (!$config) {
            $config = require(__DIR__ . '/config/region.php');
        }
        $this->db = new Connection($config);
    }
    
    /**
     * Get the database connection;
     * @return Connection the database connection.
     */
    public function getDb()
    {
        return $this->db;
    }
    
    /**
     * Get the Country instance with specified Alpha2 Code;
     * @param string $alpha2
     * @return Country|null return Country instance if founded, or return null.
     */
    public static function getCountry($alpha2)
    {
        if (is_string($alpha2))
        {
            return Country::findOne(['alpha2' => $alpha2]);
        }
        return null;
    }
    
    public static function getAllCountries()
    {
        return Country::find()->all();
    }
    
    public static function getProvince($country, $alpha2)
    {
        if (is_string($country) && is_string($alpha2))
        {
            return Province::findOne(['country' => $country, 'alpha2' => $alpha2]);
        }
        return null;
    }
    
    public static function getAllProvinces($country)
    {
        return Province::find()->where(['country' => $country])->all();
    }
    
    public static function getCity($country, $province, $alpha)
    {
        if (is_string($country) && is_string($province) && is_string($alpha))
        {
            return City::findOne(['country' => $country, 'province' => $province, 'alpha' => $alpha]);
        }
        return null;
    }
    
    public static function getAllCites($country, $province)
    {
        return City::find()->where(['country' => $country, 'province' => $province])->all();
    }
    
    public static function getDistrict($country, $province, $city, $alpha)
    {
        if (is_string($country) && is_string($province) && is_string($city) && is_string($alpha))
        {
            return District::findOne(['country' => $country, 'province' => $province, 'city' => $city, 'alpha' => $alpha]);
        }
        return null;
    }
    
    public static function getAllDistricts($country, $province, $city)
    {
        return District::find()->where(['country' => $country, 'province' => $province, 'city' => $city])->all();
    }
    
    /**
     * Get the value with the specified key.
     * @param string $key the value to be fetched.
     * @return string the value correspodding with the key.
     */
    public static function getSettingValue($key)
    {
        if (is_string($key)){
            return Setting::findOne(['key' => $key])['value'];
        }
        return null;
    }    
    
    /**
     * Get the version of database.
     * @return string the version number of database, in the format of 'YYYYMMDD';
     */
    public static function version()
    {
        return self::getSettingValue('version');
    }
}
