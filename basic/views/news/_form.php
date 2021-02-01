<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'createAt')->textInput() ?>

    <?= $form->field($model, 'createBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modifyAt')->textInput() ?>

    <?= $form->field($model, 'modifyBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleteAt')->textInput() ?>

    <?= $form->field($model, 'deleteBy')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
