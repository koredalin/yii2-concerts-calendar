<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Band Concerts Calendar</h1>
    </div>
        
    <div class="center-text">
        <?php
        if (\Yii::$app->user->isGuest) {
            echo Html::a('Log-in', ['/user/login'], ['class' => 'btn btn-lg btn-success homepage-anchor-button']);
            echo Html::a('Register', ['/user/register'], ['class' => 'btn btn-lg btn-primary homepage-anchor-button']);
        } else {
            echo Html::a('Concerts', ['/concert/index'], ['class' => 'btn btn-lg btn-success homepage-anchor-button']);
            echo Html::a('Elastic Search', ['/elasticconcert/index'], ['class' => 'btn btn-lg btn-success homepage-anchor-button']);
            echo Html::a('Bands', ['/band/index'], ['class' => 'btn btn-lg btn-primary homepage-anchor-button']);
            if (\Yii::$app->user->identity->isAdmin) {
                echo Html::a('Countries', ['/country/index'], ['class' => 'btn btn-lg btn-warning homepage-anchor-button']);
            }
        }
        ?>
    </div>

<!--    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>-->
</div>
