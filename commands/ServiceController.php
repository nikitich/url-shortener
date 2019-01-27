<?php
/**
 * Created by PhpStorm.
 * User: nikitich
 * Date: 27.01.19
 * Time: 20:52
 */

namespace app\commands;

use app\models\Url;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Expression;
use yii\db\StaleObjectException;

class ServiceController extends Controller
{
    /**
     * Deleting expired URLs from DB
     *
     * @return int
     */
    public function actionClear()
    {
        $deadlineDays = env('URL_LIFE_TIME_DAYS', '20');
        $deadlineDate = new Expression("NOW() - INTERVAL $deadlineDays DAY");
        $deadUrls     = Url::find()
            ->where(['<', 'date_updated', $deadlineDate])
            ->all();

        if (is_array($deadUrls) && count($deadUrls) > 0) {
            foreach ($deadUrls as $url) {
                try {
                    $msq = "$url->short_url : $url->date_updated - deleted" . PHP_EOL;
                    if ($url->delete() !== false) {
                        echo $msq;
                    }
                } catch (StaleObjectException $e) {
                    echo $e->getMessage() . PHP_EOL;
                    return ExitCode::UNSPECIFIED_ERROR;
                } catch (\Throwable $e) {
                    echo $e->getMessage() . PHP_EOL;
                    return ExitCode::UNSPECIFIED_ERROR;
                }
            }
        } else {
            echo "There are no expired URLs in DB" . PHP_EOL;
        }

        return ExitCode::OK;
    }
}