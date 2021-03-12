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
        <h1>Ro'yxatdan o'tish</h1>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'firstname') ?>
            <?= $form->field($model, 'lastname') ?>
            <?= $form->field($model, 'gender')->radioList($options=['erkak'=>'Erkak', 'ayol'=>'Ayol'])?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?= $form->field($model, 'province')->dropdownList(ArrayHelper::map(\app\models\Provinces::find()->all(), 'id', 'province_name'), ['prompt' => 'Viloyatni tanlang']) ?>

            <?= $form->field($model, 'whois')->dropdownList(ArrayHelper::map(\app\models\Whois::find()->orderBy(['id'=>SORT_DESC])->all(), 'id', 'who'), ['prompt' => 'Kimsiz?']) ?>
      
            <?= $form->field($model, 'auth_time')->input("hidden")->label(false) ?>
            <?= $form->field($model, 'authKey')->input("hidden")->label(false) ?>
            <?= $form->field($model, 'accessToken')->input("hidden")->label(false) ?>
        
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div><!-- site-register -->

    </div>
</div>
