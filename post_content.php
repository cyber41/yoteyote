<?php require_once('templates/header.php'); ?>
<?php require_once('templates/side_bar.php'); ?>	
<?php require_once('templates/top_bar.php'); ?>

<?php require_once('lib/classes/Posts.php'); ?>
<?php require_once('lib/classes/Users.php'); ?>
	
		<div class='row'>
			<div class='col-md-12'>
			
			<?php
				
				// Checking if the ID is set for the page to load
				if(!isset($_GET['id'])){
					header("Location: index.php");
					return false;
				}
			
				// Creating a new Post Object
				$Posts = new Posts($db);
				
				// Creating a new Users Object
				$Users = new Users($db);
				
				// Un Securing the post ID
 				$post_id = $Posts->un_secure_id($_GET['id']);
				
				// Adding a New View to the Post
				$Posts->new_post_view($_SESSION['user_id'], $post_id);
				
				$rows = $Posts->get_post($post_id);
				
				foreach($rows as $post){
					
					$post_title = $post['post_title'];
					$pic = $post['post_pic'];
					$post_type = $post['post_type'];
					$post_views = $post['post_views'];
					$post_amount = $post['post_amount'];
					
					// Changing Text Color
					if($post_type == 'will'){
						$text_color = 'green_text';
						$btn_color = 'btn-green';
						$btn_text = 'Pay';
					}elseif($post_type == 'want'){
						$text_color = 'red_text';
						$btn_color = 'btn-red';
						$btn_text = 'Bid';
					}
					
					// If the picture exists
					if(file_exists("images/posts/$pic") == 1 && $pic != ''){
						$pic = "<img alt='$post_title' src='images/posts/$pic' />";
					}
					
					// Getting User
					$post_user_id = $post['post_user_id'];
					$users = $Users->get_user_by_id($post_user_id);
					
					foreach($users as $user){
						$user_first_name = $user['first_name'];
						$user_last_name = $user['last_name'];
					}
				}
			?>
			
				<div class='row'>
					
					<div class='col-md-4 boxed'>
						<div class='col-md-12 text-center post_title'><h5><span class='bolder-text <?php echo $text_color; ?>'>I <?php echo $post['post_type']; ?></span> <?php echo $post_title; ?></h5></div>
						<div class='col-md-12 post_amount'><h4><span class="label label-default currency"><?php echo $post['post_currency']; ?></span> <?php echo number_format($post['post_amount']); ?></h4></div>
						<?php echo $pic ; ?>
						<div class='col-md-12'><p><?php echo $post['post_content']; ?></p></div>
						<div class="col-md-12">
							<img alt="" src="images/users/default.png" class='post_profile_pic'>
							<div class='user_info'>
								<p>
									<strong><?php echo $user_first_name. " " . $user_last_name; ?></strong><br />
									Trusted By <span class='round-badge orange_bg'>12</span><br />
									Satisfied Users <span class='round-badge green_bg'>12</span><br />
									
								</p>
							</div>
						</div>
					</div><!-- col-md-4 -->
					
					<div class='col-md-8'>
						
						<!--Tabs alternative style-->
						<div class="tabs_framed styled">
							<div class="inner">
								<ul class="tabs clearfix active_bookmark1">
									<li class="active"><a href="#actions" data-toggle="tab">Action</a></li>
									<li><a href="#comments" data-toggle="tab"><sup class="note"><?php echo $Posts->get_total_comments($post_id) ; ?></sup>Comments</a></li>
									<li><a href="#reminders" data-toggle="tab"><sup class="note">3</sup>Reviews</a></li>
									<li><a href="#starred" data-toggle="tab">Recent Jobs</a></li>
								</ul>
						
								<div class="tab-content clearfix">
									<div class="tab-pane clearfix fade in active" id="actions">
										
										<a href="post_content.php?id=<?php echo $db->secure_id($post_id); ?>" class="btn <?php echo $btn_color; ?>"><span><?php echo $btn_text; ?></span></a>
										<h6 class='pull-right'><img src='images/pocket_money_logo_45.png' alt='Pocket Money' style='display: inline-block; margin-top:20px;'/> <span class='lighter-text text-11'>Tshs</span> 8,000</h6>
										
										<h6>Statistics</h6>
										<table class='table table-hover lighter-text'>
											<tr>
												<td><i class='glyphicon glyphicon-save no-margin'></i> Sold : <span class='pull-right'>Tshs <strong><span class='green_text'> 43,422</span></strong></span></td>
												<td><i class='glyphicon glyphicon-open no-margin'></i> Refunded : <span class='pull-right'>Tshs <strong><span class='red_text'> 32,000</span></strong></span></td>
											</tr>
											<tr>
												<td><i class='glyphicon glyphicon-eye-open no-margin'></i> Post Views : <strong><span class='green_text pull-right'><?php echo $post_views; ?></span></strong></td>
												<td><i class='glyphicon glyphicon-heart no-margin'></i> Satisfied Buyers: <strong><span class='green_text pull-right'>4</span></strong></td>
											</tr>
											<tr>
												<td><i class='glyphicon glyphicon-ok-circle no-margin'></i> Good Reviews: <strong><span class='green_text pull-right'>4</span></strong></td>
												<td><i class='glyphicon glyphicon-ban-circle no-margin'></i> Bad Reviews: <strong><span class='red_text pull-right'>4</span></strong></td>
											</tr>
										</table>
										
									</div>
									<div class="tab-pane clearfix fade" id="comments">
										
										<div class="comment-list clearfix" id="comments">
											<ol>
												<?php
													$comments = $Posts->get_post_comment($post_id);
													
													foreach($comments as $comment){
														$post_comment = $comment['comment'];
														$post_comment_date = $comment['date'];
														$post_comment_user_id = $comment['user_id'];
														
														$rows = $Users->get_user_by_id($post_comment_user_id);
														foreach($rows as $user){
															$first_name = $user['first_name'];
															$last_name = $user['last_name'];
														}
												?>
												<li class="comment">
													<div class="comment-body">
														<div class="inner">
															<div class="comment-arrow"></div>
															<div class="comment-avatar">
																<div class="avatar">
																	<img src="images/users/default.png" alt="<?php echo $first_name. " " .$last_name; ?>" />
																</div>
															</div>
															<div class="comment-text">
																<div class="comment-author clearfix">
																	<a href="#" class="link-author"><?php echo $first_name. " " .$last_name; ?></a>
																	<span class="comment-date"><?php echo $post_comment_date; ?></span> | 
																	<a href="#addcomments" class="link-reply anchor">Reply</a>
																</div>
																<div class="comment-entry"> <?php echo $post_comment; ?> </div>
															</div>
															<div class="clear"></div>
														</div>
													</div>
												</li>
												<?php } ?>
											</ol>
										</div>
										
										<div class='divider'></div>
										
										<form name='post_comment' action='process/add_comment_process.php' method='post'>
											<textarea class='col-lg-12' name='comment' placeholder="Enter your Comment Here"></textarea>
											<input type='hidden' name='post_id' value='<?php echo $post_id; ?>' />
											<span class="btn pull-right"><input type="submit" value="Send Comment" /></span>
										</form>
										
									</div>
									<div class="tab-pane clearfix fade" id="starred">
										<!--place your content here-->
									</div>
									<div class="tab-pane clearfix fade" id="archive">
										<!--place your content here-->
									</div>
								</div>
							</div>
						</div>

					</div><!-- col-md-8 -->
				</div>
				
			</div><!-- col-md-12 -->	
		</div><!--row -->

	</div><!-- col-md-9 -->

<?php include('templates/footer.php'); ?>