<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    
    <h2>Score Predictor. New/updated forecast</h2>
    
    <?php
    $forecastLink = Url::toRoute(['/forecast/page', 'id' => (int)$model->id], 'http');
    echo '<p>You can review the new/updated football prediction on: <a target="_blank" href="' . $forecastLink . '">' . $forecastLink . '</a>.</p>' . PHP_EOL;
    $forecastLink = Url::toRoute(['/forecast/list'], 'http');
    echo '<p>You can review all football predictions on: <a target="_blank" href="' . $forecastLink . '">' . $forecastLink . '</a>.</p>' . PHP_EOL;
    $subscriptionUser = Url::toRoute(['/subscription/indexuser'], 'http');
    ?>
	<hr>
        
    <h3 class="red">Stop Forecasts' subscription</h3>
    <p>You can stop or manage your subcription emails on: <a target="_blank" href="<?php echo $subscriptionUser; ?>"><?php echo $subscriptionUser; ?></a></p>
    
    <p>Thank you for using <a href="http://score-predictor.com/">http://score-predictor.com/</a>.</p>
    <p>Score Predictor team</p>
    
</body>
</html>
<?php $this->endPage() ?>
