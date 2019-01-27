<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 18:32
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use supplyhog\ClipboardJs\ClipboardJsAsset;
use supplyhog\ClipboardJs\ClipboardJsWidget;

/* @var $this yii\web\View */
/* @var $short_url string */

$this->title = Yii::$app->name . ': short URL';
ClipboardJsAsset::register($this)
?>

<div class="jumbotron">
    <h1>URL shortener</h1>

    <div class="row">
        <div class="col-xs-12">
            <h3>
                <div class="form-group">
                    Generated short URL:
                    <?php
                    try {
                        echo Html::a(
                            $short_url,
                            $short_url,
                            ['target' => '_blank']);
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo ClipboardJsWidget::widget([
                            'text'        => $short_url,
                            'label'       => 'Copy to clipboard',
                            'htmlOptions' => [
                                'class' => 'btn btn-success '
                            ]
                        ]);
                        echo '</div>';
                    } catch (Exception $e) {
                        echo $short_url;
                        echo '</div>';
                    }
                    ?>
                </div>
            </h3>
        </div>
    </div>
</div>
