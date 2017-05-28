<?php
namespace frontend\widgets\MultiLang;
use yii\helpers\Html;
use Yii;
?>

<div class="btn-group <?= $cssClass; ?>">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <span class="uppercase"><?= Yii::$app->language; ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php foreach (Yii::$app->params['langs'] as $lang) {
            if (Yii::$app->language == $lang) { continue; }
            ?>
            <li class="item-lang">
                <?= Html::a(strtoupper($lang), array_merge(
                    \Yii::$app->request->get(),
                    ['/' . Yii::$app->controller->route, 'language' => $lang]
                )); ?>
            </li>
        <? }?>
    </ul>
</div>