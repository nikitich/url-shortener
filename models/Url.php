<?php

namespace app\models;

use yii\db\Expression;

/**
 * This is the model class for table "url".
 *
 * @property string $short_url
 * @property string $full_url
 * @property string $date_created
 * @property string $full_url_hash [varchar(32)]
 * @property string $date_updated [datetime]
 */
class Url extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url';
    }

    public static function generateUrlHash(string $full_url)
    {
        return md5($full_url);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['short_url', 'string', 'max' => 6],
            ['short_url', 'unique'],
            ['short_url', 'required'],

            ['full_url', 'required'],
            ['full_url', 'string'],
            ['full_url', 'url'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'short_url'    => 'Short Url',
            'full_url'     => 'Full Url',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->validate()) {
            $runValidation       = false;
            $this->date_updated  = (new Expression('NOW()'));
            $this->full_url_hash = self::generateUrlHash($this->full_url);
        }

        return parent::save($runValidation, $attributeNames);
    }
}
