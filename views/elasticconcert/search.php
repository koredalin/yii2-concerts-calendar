<?php

use yii\helpers\Html;
//use yii\helpers\BaseStringHelper;

$this->title = 'Search';
?>
<div class='container-fluid'>
<h1>Search Result for <?php echo '<span class="label label-success">' . $query . '</span>' ?></h1>
<?php
$searchResults = $dataProvider->getModels();

if (is_array($searchResults) && count($searchResults) > 0) {
    foreach ($searchResults as $result) {
        if (!array_key_exists('_source', $result)) {
            continue;
        }
        echo '<div class="row">';
        echo '<div class="panel panel-default">';
        if (isset($result['_source']['concert_location'])) {
            echo '<div class="panel-heading"><strong>' . $result['_source']['concert_location'] . '</strong></div>';
        }
        foreach ($result['_source'] as $key => $value) {
            echo '<div class="panel-body inline-block"><strong>' . $key . '</strong><br>';
            echo '<span>' . $value . '</span></div>';
        }
        echo '</div>';
        echo '</div>';
    }
}?>
</div>

<div id='search-again'><?php echo Html::a('Search again', ['/elasticconcert/index'], ['class' => 'btn btn-primary']); ?></div> 