<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 17:24
 */

namespace app\models;


use yii\base\Model;

class UrlForm extends Model
{
    public $url;

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['url', 'filter', 'filter' => 'trim'],
            ['url', 'required'],
            ['url', 'string'],
            ['url', 'url'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'url' =>  'Full URL',
        ];
    }
}