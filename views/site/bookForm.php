<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:41 PM
 *
 * @var $model \app\models\forms\BookForm
 */
$form = \yii\bootstrap\ActiveForm::begin();

echo $form->field($model, 'title'),
    $form->field($model, 'slug'),
    $form->field($model, 'language_code')->label(false)->hiddenInput(['style' => 'display: none']),
    $form->field($model, 'download_link'),
    $form->field($model, 'categories'),
    $form->field($model, 'photos'),
    \yii\helpers\Html::tag('div', \yii\helpers\Html::button(Yii::t('buttons', 'Add book'), ['class' => 'btn btn-success', 'type' => 'submit']), ['class' => 'text-center']);

$form->end();