<?php
require __DIR__ . '/../vendor/autoload.php';

(new Dotenv\Dotenv(__DIR__ . '/../'))->load();

if (env('APP_ENV', 'production') === 'production') {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'production');
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

try {
    (new yii\web\Application($config))->run();
} catch (\yii\base\InvalidConfigException $e) {
    require __DIR__ . '/errors/error500.php';
}