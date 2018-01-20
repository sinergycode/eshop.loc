<?php
use yii\helpers\Html;
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;

$this->title = 'E-SHOPPER | Статьи';
?>

<h2 class="title text-center">Последние публикации</h2>

<div class="container blog-post-area">
 <?php if(!empty($posts)) : ?>
    <?php foreach($posts as $post): ?>
        <?php $mainImg = $post->getImage(); ?>
        <div class="panel panel-default single-blog-post">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="<?=  yii\helpers\Url::to(['post/view', 'id' => $post->id])?>"><?=$post->title?></a></h3>
            </div>
            
            <div class="post-meta">
                    <ul>
                            <li><i class="fa fa-user"></i> <?= $post->author?> </li>
                            <li><i class="fa fa-clock-o"></i> <?= Yii::$app->formatter->asTime($post->time); ?> </li>
                            <li><i class="fa fa-calendar"></i> <?= Yii::$app->formatter->asDate($post->date); ?> </li>
                    </ul>            
                    <div class="star-main-container">
                                        
                        <span class="star-container voters"><?php echo $post->rating[0]['number_votes'] ? $post->rating[0]['number_votes'] . " человек" : " " ?></span>
                                                
                        <span class="star-container">
                                                                            
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <?php 
                            echo StarRating::widget([
                                'name' => $post->post_rate,
        //                        'value' => isset($post->post_rate) ? $post->post_rate : 0,
                                'value' => isset($post->rating[0]['dec_avg']) ? $post->rating[0]['dec_avg'] : 0,
                                'pluginOptions' => [
                                        'size'=>'xs',
        //                                'step' => 0.1,
        //                                'theme' => 'krajee-fa',
                                        'filledStar' => '&#x2605;',
                                        'emptyStar' => '&#x2606;',
        //                                'value' => 2,
                                        'disabled' => true,
                                        'showClear'=>false,
//                                        'displayOnly' => true, 
                                        'showCaption' => false,
                                    ], 
                            ]); ?>
                                <?php ActiveForm::end(); ?>
                        </span>
                        
                        <span class="star-container dec-avg"> <?php echo $post->rating[0]['dec_avg'] ? "Оценка: " . $post->rating[0]['dec_avg'] : "Без оценки" ?></span>
                                        
                    </div>
	    </div>
            
            <a href="<?=  yii\helpers\Url::to(['post/view', 'id' => $post->id])?>">
                <?= Html::img($mainImg->getUrl('168x'), ['alt' => $post->title])?>
            </a>

            <div class="panel-body">
                <?= $post->excerpt; ?>
            </div>
            <a  class="btn btn-primary" href="<?=  yii\helpers\Url::to(['post/view', 'id' => $post->id])?>">Read More</a>
        </div>
    <?php endforeach; ?>
  <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
 <?php endif; ?>
</div>