<?php

namespace app\components\widgets\language;

/**
 * Class LanguageWidget
 * @package app\components\widgets\language
 */
class LanguageWidget extends \yii\bootstrap\Widget
{
    /**
     * @var string
     */
    public $cssClass;

    public function init(){}

    /**
     * @return string
     */
    public function run() {

        return $this->render('widget', [
            'cssClass' => $this->cssClass,
        ]);
    }
}