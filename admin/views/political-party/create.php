<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\models\PoliticalParty */

$this->title = 'Create Political Party';
$this->params['breadcrumbs'][] = ['label' => 'Political Parties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="political-party-create">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
