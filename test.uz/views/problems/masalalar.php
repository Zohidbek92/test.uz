<?php
use yii\helpers\Url;
?>

<div class="row">
	<div class="col-lg-12">

	<?php

	foreach ($masalalar as $masala) {
		$url = Url::to(['problems/solutions', 'problem_id' => $masala->id]);
		$sana = substr($masala->adddate, 0, 16);
		$sana = Yii::$app->formatter->asDate($sana, 'php: d-M,Y / H:i');
		echo "<a href='".$url."'># ".$masala->problem_about."</a> <span class='masala_sana'>".$sana."</span>";
		echo "<h4>".substr($masala->problem_text, 0, 200)."</h4>";
	}
?>	
<?php
echo \yii\widgets\LinkPager::widget(['pagination' => $sahifa]);
?>
	</div>
</div>
