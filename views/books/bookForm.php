<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:41 PM
 *
 * @var $model \app\models\forms\BookForm
 */
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'title').
    $form->field($model, 'language_code')->dropDownList($model->getLanguageCodes()).
    $form->field($model, 'categories[]')->widget(\kartik\select2\Select2::className(), [
        'language'  => \Yii::$app->language,
        'data'      => ArrayHelper::map($categories, 'id', 'tag'),
        'options'   => ['multiple' => true, 'placeholder' => \Yii::t('placeholders', 'Enter some categories for book')],
        'pluginOptions' => [
            'tokenSeparators'   =>  [',', ' '],
            'allowClear'        =>  true
        ],
    ]).
    $form->field($model, 'tags[]')->widget(\kartik\select2\Select2::className(), [
        'language'  => \Yii::$app->language,
        'data'      => ArrayHelper::map($tags, 'id', 'tag'),
        'options'   => ['multiple' => true, 'placeholder' => \Yii::t('placeholders', 'Enter some tags for book')],
        'pluginOptions' => [
            'tags'              =>  true,
            'tokenSeparators'   =>  [',', ' '],
            'allowClear'        =>  true
        ],
    ]).
    $form->field($model, 'description')->widget(Widget::className(), [
        'settings' => [
            'lang' => \Yii::$app->language,
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen'
            ]
        ]
    ]).
    $form->field($model, 'book_file')->fileInput().
    $form->field($model, 'photos_files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']).
    Html::tag('div',
        Html::button(Yii::t('buttons', 'Add book'), ['class' => 'btn btn-success', 'type' => 'submit']),
        [
            'class' => 'text-center'
        ]
    );

$form->end();