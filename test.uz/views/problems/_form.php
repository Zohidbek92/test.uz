<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Problems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="problems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'problem_about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_text')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
]); ?>

    <?= $form->field($model, 'category_id')->dropdownList(ArrayHelper::map(\app\models\Math_category::find()->all(), 'id', 'category_name'), ['prompt' => 'Mos kategoriya tanlang?']) ?>

    <?= $form->field($model, 'adddate')->hiddenInput(['value' => date("Y-m-d H:i:s")])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
