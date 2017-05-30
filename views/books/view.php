<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/30/17
 * Time: 9:41 AM
 *
 * @var \app\models\Books $book
 */
use yii\bootstrap\Html;

var_dump($book);
?>

<div class="text-center">
    <div class="col-sm-8 col-sm-offset-2">
        <h2 class="title-one"><?= Html::encode($book->title) ?></h2>
        <p>Lorem equat.</p>
    </div>
</div>
