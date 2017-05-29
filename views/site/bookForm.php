<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:41 PM
 *
 * @var $model \app\models\forms\BookForm
 */
use yii\helpers\Html;

$form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'title').
    $form->field($model, 'language_code')->dropDownList($model->getLanguageCodes()).
    $form->field($model, 'description').
    $form->field($model, 'categories').
    $form->field($model, 'book_file')->fileInput().
    $form->field($model, 'photos_files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']).
    Html::tag('div',
        Html::button(Yii::t('buttons', 'Add book'), ['class' => 'btn btn-success', 'type' => 'submit']),
        [
            'class' => 'text-center'
        ]
    );

$form->end();