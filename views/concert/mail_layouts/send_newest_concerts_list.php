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
    
    <h2><?php echo $this->title; ?></h2>
    
    <?php
    
    if (is_array($newestConcerts) && count($newestConcerts) > 0) {
        echo '<hr>'.PHP_EOL;
        foreach ($newestConcerts as $key => $concert) {
            $concertLink = Url::toRoute(['/concert/view', 'id' => (int)$concert['id']], 'http');
        ?>
        <p>Concert: <?= substr($concert['description'], 0, 70) ?>... <a target="_blank" href="<?= $concertLink ?>">Read more.</a></p>
        <ul>
            <li>Date: <?= $concert['date'] ?></li>
            <li>Band: <?= $concert['band_name'] ?></li>
            <li>Location: <?= $concert['location'].'('.$concert['country'].')' ?></li>
        </ul>
        <hr>
        <?php
        }
    }
    ?>
    
    <p>Thank you for using our web site.</p>
    <p>Band Concerts Calendar team</p>
    
</body>
</html>
<?php $this->endPage() ?>
