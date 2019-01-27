<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 17:31
 */

namespace app\services;

use Yii;
use app\models\Url;

class UrlService
{
    /**
     * Method returning valid instance of Url
     * determing on recived full URL string
     *
     * @param string $fullUrl
     * @return Url
     * @throws \yii\base\Exception
     */
    public static function getUrlInstance(string $fullUrl): Url
    {

        $url = Url::findOne(['full_url_hash' => Url::generateUrlHash($fullUrl)]);

        $url = empty($url) ? self::getNewUrlInstance($fullUrl) : $url;

        return $url;
    }

    /**
     * Fabric method generating new Url instance
     *
     * @param string $fullUrl
     * @return Url
     * @throws \yii\base\Exception
     */
    public static function getNewUrlInstance(string $fullUrl): Url
    {
        do {
            $shortUrl = Yii::$app->getSecurity()->generateRandomString(intval(env('URL_LENGHT', 6)));
        } while (Url::findOne(['short_url' => $shortUrl]));

        return new Url([
            'full_url'  => $fullUrl,
            'short_url' => $shortUrl,
        ]);
    }
}