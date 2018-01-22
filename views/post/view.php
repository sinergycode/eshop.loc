<?php 
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;
use \yii2mod\comments\widgets\Comment;
?>

<div class="container blog-post-area">
        <div class="panel panel-default single-blog-post">
            
            <div class="panel-heading">
                <h3 class="panel-title"><?=$post->title?></a></h3>
            </div>

            <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> <?=$post->author?> </li>
                        <li><i class="fa fa-clock-o"></i> <?= Yii::$app->formatter->asTime($post->time); ?> </li>
                        <li><i class="fa fa-calendar"></i> <?= Yii::$app->formatter->asDate($post->date); ?> </li>
                    </ul>
                
                    <div class="star-main-container">
                        
                        <span class="star-container voters"><?php echo $post->rating[0]['number_votes'] ?> человек</span>
                        
                        <span class="star-container">
                                           
                        <?php 
                            $js = <<<JS
                            function forRatingChange (event, value, caption) { 
                                $.ajax({
                                    type: 'POST', 
                                    url: '/rating/get-params', 
                                    data: { 
                                        points: value, 
                                        post_id: $post->id
                                    }, 
                                    dataType:'json',
                                    success: function(response) {
                                        console.log(response.success);
                                        console.log(response.is_guest);
                                        console.log(response.user);
                                        $(event.currentTarget).rating('update', response.dec_avg);
                                        document.getElementsByClassName('voters')[0].innerHTML = response.number_votes + " человек";
                                        document.getElementsByClassName('dec-avg')[0].innerHTML = "Оценка: " + response.dec_avg;
                                    }, 
                                    error: function(e) {
                                        console.log('not sent');
                                        console.log(e.responseText); 
                                    }  
                                }); 
                            }
JS;
$this->registerJs($js);          
                        ?>
                                 
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
                                    'disabled' => false,
                                    'showClear'=> false,
                                    'displayOnly' => $user->vote_status ? true : false, 
                                    'showCaption' => false,
                                ], 
                                'pluginEvents' => [
                                    'rating:change' => $js,
                                ],
                        ]); ?>
                            <?php ActiveForm::end(); ?>
                        </span>

                        <span class="star-container dec-avg"> Оценка: <?php echo $post->rating[0]['dec_avg'] ?></span>
                    </div>
            </div>
            
            <div class="panel-body">
              <?= $post->text; ?>
            </div>

            <div class="pager-area">
                    <ul class="pager pull-right">
                            <li><a href="<?= yii\helpers\Url::to(['post/view', 'id' => $post->id - 1])?>">Pre</a></li>
                            <li><a href="<?= yii\helpers\Url::to(['post/view', 'id' => $post->id + 1])?>">Next</a></li>
                    </ul>
            </div>
            
        </div>
    
    					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->
                                        
                                        <div class="socials-share">
						<a href=""><img src="/images/blog/socials.png" alt="socials.png"></a>
					</div><!--/socials-share-->

<!--					<div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="/images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div>Comments-->

<!--					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">
							<li class="media">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="/images/blog/man-two.jpg" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							<li class="media second-media">
								<a class="pull-left" href="#">
									<img class="media-object" src="/images/blog/man-three.jpg" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							<li class="media">
								<a class="pull-left" href="#">
									<img class="media-object" src="/images/blog/man-four.jpg" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
						</ul>					
					</div>/Response-area-->

<!--					<div class="replay-box">
						<div class="row">
							<div class="col-sm-4">
								<h2>Leave a replay</h2>
								<form>
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<input type="text" placeholder="write your name...">
									<div class="blank-arrow">
										<label>Email Address</label>
									</div>
									<span>*</span>
									<input type="email" placeholder="your email address...">
									<div class="blank-arrow">
										<label>Web Site</label>
									</div>
									<input type="email" placeholder="current city...">
								</form>
							</div>
							<div class="col-sm-8">
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<textarea name="message" rows="11"></textarea>
									<a class="btn btn-primary" href="">post comment</a>
								</div>
							</div>
						</div>
					</div>/Repaly Box-->

        <?php echo Comment::widget([
            'model' => $post,
            'dataProviderConfig' => [
                  'pagination' => [
                      'pageSize' => 4
                  ],
//            'listViewConfig' => [
//              'emptyText' => Yii::t('app', 'No comments found.'),
//            ],
      ]
        ]); ?>

</div>