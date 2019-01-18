<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\PoliticalParty */

$this->title = 'Update categories' ;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="political-party-update">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
