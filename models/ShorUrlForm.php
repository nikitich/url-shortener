<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 21:49
 */

namespace app\models;


use yii\base\Model;

class ShorUrlForm extends Model
{
    public $short_url;

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['short_url', 'filter', 'filter' => 'trim'],
            ['short_url', 'required'],
            ['short_url', 'string', 'length' => intval(env('URL_LENGHT', 6))],
            ['short_url', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => 'contains unacceptable symbols'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'short_url' => 'Short URL',
        ];
    }
}