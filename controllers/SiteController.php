<?php

namespace app\controllers;

use app\helpers\FlashHelper;
use app\models\ShorUrlForm;
use app\models\Url;
use app\services\UrlService;
use Yii;
use app\models\UrlForm;
use yii\base\Exception;
use yii\helpers\Url as UrlHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'encode' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $FormModel = new UrlForm();

        return $this->render('index', [
            'model' => $FormModel,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Encode recived full URL from POST and displays
     * the generated short URL
     *
     * @return string|\yii\web\Response
     */
    public function actionEncode()
    {
        $model = new UrlForm();
        if ($model->load(Yii::$app->request->post())
            && $model->validate()
        ) {
            try {
                $url = UrlService::getUrlInstance($model->url);
                if ($url->save()) {
                    return $this->render('encode', [
                        'short_url' => UrlHelper::to('/' . $url->short_url, true),
                    ]);
                }
            } catch (Exception $e) {
                FlashHelper::setErrorFlash($e->getMessage());
            }
        }

        FlashHelper::loadErrorsFromModel($model);

        return $this->goHome();
    }

    /**
     * Decode recieved short URL and redirect
     * to the target full URL
     *
     * @param $short_url
     * @return \yii\web\Response
     */
    public function actionDecode($short_url)
    {
        $model = new ShorUrlForm(['short_url' => $short_url]);

        if ($model->validate()) {
            $url = Url::findOne(['short_url' => $short_url]);
            if (empty($url)) {
                FlashHelper::setErrorFlash('URL Not found');
            } else {
                return $this->redirect($url->full_url);
            }
        }

        FlashHelper::loadErrorsFromModel($model);

        return $this->goHome();
    }
}
