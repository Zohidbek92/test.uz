<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProblemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masalalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problems-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Masala yozish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'problem_about',
            'problem_text:ntext',
            // 'category_id',
                [   'attribute' => 'category_id',
                    'label' => 'Kategoriya',
                    'value' => function($d)
                    {
                        return $d->kategoriya->category_name;
                    }
                ],
            //'adddate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
