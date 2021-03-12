<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Solutions */
/* @var $form ActiveForm */
?>
<div class="col-lg-8 col-12 problems-solutions">

    <?php
        echo "<h5>".$problem->problem_about."</h5>";
        echo "<h4>".$problem->problem_text."</h4>";
    ?>
    <br>
    <h4>Izohlar</h4>
    <?php
    foreach ($solutions as $solution) {
        echo "<div style='border: 1px dotted #999; margin-bottom:5px; padding: 8px 10px 0 10px; border-radius:3px;'>";
        $sana = substr($solution->adddate, 0, 16);
        $sana = Yii::$app->formatter->asDate($sana, 'php: d-M.Y H:i');
       echo "<b>".$solution->user->firstname." ".$solution->user->lastname."</b>";
       echo "<span style='font-size: 12px; color: #777'>".$sana."</span>";
       echo $solution->solution_text;

       if($solution->user_id == Yii::$app->user->identity->id or $problem->user_id == Yii::$app->user->identity->id)
       {
            echo "<a href='index.php?r=problems/deletesolution&solution_id=".$solution->id."&problem_id=".$solution->problem_id."&uid=".$solution->user_id."' style='color: #999;'>O'chirish</a>";
       }
       echo "</div>";
    }
    ?>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'problem_id')->hiddenInput(['value' => $problem->id])->label(false) ?>
        <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>
        <?= $form->field($model, 'solution_text')->widget(CKEditor::className(),[
																		    'editorOptions' => [
																		        'preset' => 'basic',
																		        'inline' => false,
																		    ],
																		]); ?>
        <?= $form->field($model, 'adddate')->hiddenInput()->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('OK', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- problems-solutions -->
