<?php
use yii\helpers\Html;
?>
    <h2>Band Concert Details</h2>
    
    <?php
    if (isset($model)) {
        ?>
    <table>
        <tr><td><strong>ID</strong></td><td><?= $model->id ?></td></tr>
        <tr><td><strong>Date</strong></td><td><?= $model->date ?></td></tr>
        <tr><td><strong>Band</strong></td><td><?= $model->band->band_name ?></td></tr>
        <tr><td><strong>Location</strong></td><td><?= $model->location ?></td></tr>
        <tr><td><strong>Country</strong></td><td><?= $model->country->country_name ?></td></tr>
        <tr><td><strong>Description</strong></td><td><?= $model->description ?></td></tr>
        <tr><td><strong>Has Photo</strong></td><td><?= $model->has_photo ?></td></tr>
        <tr><td><strong>Created At</strong></td><td><?= $model->created_at ?></td></tr>
        <tr><td><strong>Updated At</strong></td><td><?= $model->updated_at ?></td></tr>
        <tr><td><strong>Band Photo</strong></td><td><?php if ($model->has_photo) {
                echo Html::img('@web/'.$model->photo_file_path, array('alt' => 'Server Band Concert Photo.', 'class' => 'bandConcertPhoto', 'style' => array('max-width: 400px;', 'width: 80%')));
            }
            ?></td></tr>
    </table>
        <?php
    }
    ?>
    
    <p>Thank you for using our web site.</p>
    <p>Band Concerts Calendar team</p>