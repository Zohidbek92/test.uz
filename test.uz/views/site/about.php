<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $userOne->firstname;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    
    <p>
        
    	<?php
    		echo "<h1>".$userOne->firstname." ".$userOne->lastname."</h1>";

    		echo "<h3> Viloyat: ".$userOne->viloyat->province_name."</h3>";
    		echo "<h3> Hozirda: ".$userOne->kasb->who."</h3>";

    		$sana = substr($userOne->auth_time, 0, 10);
    		echo "<h6> Ro'yxatdan o'tgan sana: ".Yii::$app->formatter->asDate($sana, 'php: d-M, Y')."</h6>";

    	?>

        		<?php //echo json_encode($one_user->attributes); ?>
    </p>
    <a href="<?php echo Url::to(['site/edit-profile', 'id'=>Yii::$app->user->id])?>" class="btn btn-primary">Profilni tahrirlash</a>
</div>
