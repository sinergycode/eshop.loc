<?php
use yii\helpers\Html;
$this->title = 'E-SHOPPER | Статьи';
?>

<h2 class="title text-center">Latest From our Blog</h2>

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
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
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