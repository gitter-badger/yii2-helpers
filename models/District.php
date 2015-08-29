<?php

namespace vistart\Helpers\models;

use Yii;
use vistart\Helpers\Geolocation;

/**
 * This is the model class for table "district".
 *
 * @property string $alpha
 * @property string $localname
 * @property string $romanname
 * @property integer $numericcode
 * @property string $city
 * @property string $province
 * @property string $country
 *
 * @property Country $country0
 * @property Province $province0
 * @property City $city0
 * 
 * @author vistart <i@vistart.name>
 */
final class District extends \yii\db\ActiveRecord
{
    public static function asArray($districts = [])
    {
        if (!is_array($districts)) {
            return null;
        }
        $districtArray = [];
        for ($i = 0; $i < count($districts); $i++){
            $districtArray[$i] = ['localname' => $districts[$i]['localname'], 'alpha' => $districts[$i]['alpha']];
        }
        return $districtArray;
    }
    public static function asArrayWithKeys($districts = [])
    {
        if (!is_array($districts)) {
            return null;
        }
        $districtArray = [];
        for ($i = 0; $i < count($districts); $i++){
            $districtArray[$districts[$i]['alpha']] = ['localname' => $districts[$i]['localname']];
        }
        return $districtArray;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return (new Geolocation())->getDb();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alpha', 'localname', 'romanname', 'numericcode', 'city', 'province', 'country'], 'required'],
            [['alpha', 'localname', 'romanname', 'city', 'province', 'country'], 'string'],
            [['numericcode'], 'integer'],
            [['numericcode', 'alpha', 'localname', 'romanname', 'city'], 'unique', 'targetAttribute' => ['numericcode', 'alpha', 'localname', 'romanname', 'city'], 'message' => 'The combination of Alpha, Localname, Romanname, Numericcode and City has already been taken.'],
            [['alpha'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alpha' => 'Alpha',
            'localname' => 'Localname',
            'romanname' => 'Romanname',
            'numericcode' => 'Numericcode',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['alpha2' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince0()
    {
        return $this->hasOne(Province::className(), ['alpha2' => 'province']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(City::className(), ['alpha' => 'city']);
    }
}
