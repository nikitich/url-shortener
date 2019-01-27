<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::$app->name . ': About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the URL shortener online service.
    </p>

</div>
