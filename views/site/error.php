<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
?>

<div class="site-error container">
    
    		<div class="content-404">		
                    <h1><?= nl2br(Html::encode($message)) ?></h1>   
                    <?= Html::img("@web/images/404/404.png", ['class' => 'img-responsive', 'alt' => 'ошибка 404'])?>
                    <h2><a href="<?= \yii\helpers\Url::to(['/']) ?>">Перейти на главную страницу</a></h2>
		</div>
</div>
