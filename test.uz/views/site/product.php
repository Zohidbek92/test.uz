<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form ActiveForm */
?>
<div class="site-product">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nomi') ?>
        <?= $form->field($model, 'narxi') ?>
        <?= $form->field($model, 'kategoriya') ?>
        <?= $form->field($model, 'reyting') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-product -->
