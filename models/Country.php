<?php

namespace vistart\Helpers\models;

use Yii;
use vistart\Helpers\Geolocation;

/**
 * This is the model class for table "country".
 *
 * @property string $alpha2
 * @property string $shortname
 * @property string $lowercase
 * @property string $fullname
 * @property string $alpha3
 * @property integer $numericcode
 * @property string $remarks
 * @property boolean $independent
 * @property string $territory
 * @property string $remark1
 * @property string $langalpha2
 * @property string $langalpha3
 * @property string $localshortname
 *
 * @property Province[] $provinces
 * 
 * @author vistart <i@vistart.name>
 */
class Country extends \yii\db\ActiveRecord
{
    public static function asArray($countries = [])
    {
        if (!is_array($countries)) {
            return null;
        }
        $countryArray = [];
        for ($i = 0; $i < count($countries); $i++){
            $countryArray[$i] = ['shortname' => $countries[$i]['lowercase'] . ' (' . $countries[$i]['fullname'] . ')', 'alpha2' => $countries[$i]['alpha2'], 'fullname' => $countries[$i]['fullname']];
        }
        return $countryArray;
    }
    
    public static function asArrayWithKeys($countries = [])
    {
        if (!is_array($countries)) {
            return null;
        }
        $countryArray = [];
        for ($i = 0; $i < count($countries); $i++){
            $countryArray[$countries[$i]['alpha2']] = ['shortname' => $countries[$i]['lowercase'], 'fullname' => $countries[$i]['fullname']];
        }
        return $countryArray;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
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
            [['alpha2', 'shortname', 'lowercase', 'fullname', 'alpha3', 'numericcode', 'langalpha2', 'langalpha3', 'localshortname'], 'required'],
            [['alpha2', 'shortname', 'lowercase', 'fullname', 'alpha3', 'remarks', 'territory', 'remark1', 'langalpha2', 'langalpha3', 'localshortname'], 'string'],
            [['numericcode'], 'integer'],
            [['independent'], 'boolean'],
            [['numericcode'], 'unique'],
            [['alpha3'], 'unique'],
            [['fullname'], 'unique'],
            [['lowercase'], 'unique'],
            [['shortname'], 'unique'],
            [['alpha2'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alpha2' => 'Alpha2',
            'shortname' => 'Shortname',
            'lowercase' => 'Lowercase',
            'fullname' => 'Fullname',
            'alpha3' => 'Alpha3',
            'numericcode' => 'Numericcode',
            'remarks' => 'Remarks',
            'independent' => 'Independent',
            'territory' => 'Territory',
            'remark1' => 'Remark1',
            'langalpha2' => 'Langalpha2',
            'langalpha3' => 'Langalpha3',
            'localshortname' => 'Localshortname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Province::className(), ['country' => 'alpha2'])->inverseOf('country0');
    }
}
