<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="row">
    
    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
        
    <div class="site-register">
        <h1>Profilni tahrirlash</h1>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($ep, 'firstname') ?>
            <?= $form->field($ep, 'lastname') ?>
            <?= $form->field($ep, 'gender')->radioList($options=['erkak'=>'Erkak', 'ayol'=>'Ayol'])?>
            <?= $form->field($ep, 'province')->dropdownList(ArrayHelper::map(\app\models\Provinces::find()->all(), 'id', 'province_name'), ['prompt' => 'Viloyatni tanlang']) ?>
            <?= $form->field($ep, 'whois')->dropdownList(ArrayHelper::map(\app\models\Whois::find()->orderBy(['id'=>SORT_DESC])->all(), 'id', 'who'), ['prompt' => 'Kimsiz?']) ?>
            <?= $form->field($ep, 'password')->hiddenInput(['value' => $ep->password])->label(false) ?>
            <?= $form->field($ep, 'password_repeat')->hiddenInput(['value' => $ep->password])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div><!-- site-register -->

    </div>
</div>
