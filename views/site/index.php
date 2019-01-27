<?php

/* @var $this yii\web\View */

/* @var $model \app\models\UrlForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::$app->name . ': URL sortener';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>URL shortener</h1>

        <?php $form = ActiveForm::begin([
            'layout'      => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label'   => 'col-xs-2',
                    'wrapper' => 'col-xs-9',
                ]
            ],
            'action'      => 'encode'
        ]) ?>

        <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Get short URL', ['class' => 'btn btn-primary', 'name' => 'url-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
