<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:41 PM
 *
 * @var $model \app\models\forms\BookForm
 */
echo \yii\helpers\Html::tag('div', $this->render('bookForm', [
    'model' => $model,
    'tags' => $tags,
    'categories' => $categories
]));