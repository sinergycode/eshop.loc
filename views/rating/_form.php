<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Rating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'rate')->widget(StarRating::classname(), [
    'pluginOptions' => ['size'=>'lg']
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>