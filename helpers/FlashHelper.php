<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 18:47
 */

namespace app\helpers;

use Yii;
use yii\base\Model;

class FlashHelper
{
    const UNDEFINED_MSG = 'undefined';

    public static function setErrorFlash($msg = self::UNDEFINED_MSG)
    {
        Yii::$app->session->setFlash('error', $msg);
    }

    public static function loadErrorsFromModel(Model $model, $header = '')
    {
        if ($model->hasErrors()) {
            $msg = empty(trim($header)) ? '': "<strong>$header</strong>" . PHP_EOL;
            $msg .= "<ul>" . PHP_EOL;
            foreach ($model->getErrors() as $attribute => $errors) {
                if (is_array($errors) && count($errors) > 0) {
                    foreach ($errors as $error) {
                        $label = $model->getAttributeLabel($attribute);
                        $msg .= "<li> <strong>$label</strong> : $error </li>" . PHP_EOL;
                    }
                }
            }
            self::setErrorFlash($msg);
        }
    }
}