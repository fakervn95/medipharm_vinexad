<?php 
/*
Template Name: page-template-trangchu
*/
get_header(); 
?>	
<div class="page-wrapper">
	<div id="content">
		<div class="content_post_admin">
			<?php 
		$my_postid = 16;//This is page id or post id
		$content_post = get_post($my_postid);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
		?>
	</div>
	<div class="g_content">
		<div class="container">
			<div class="content_left">
				<div class="list_post_news">
					<div class="container">
						<h2 class="title_tg_top">Bài viết mới nhất</h2>
						<div class="row">
							<?php 
							$arg_cmt_post_q = array(
								'posts_per_page' => 3,
								'orderby' => 'post_date',
								'order' => 'DESC',
								'post_type' => 'post',
								'post_status' => 'publish',
							);
							$cmt_post_q = new WP_Query();
							$cmt_post_q->query($arg_cmt_post_q);
							?>
							<?php if(have_posts()) : ?>
								<ul class="most-commented">
									<?php
									while ($cmt_post_q->have_posts()) : $cmt_post_q->the_post(); ?>
										<li>
											<div class="post_cmt_wrapper pw">
												<div class="wrap_thumb">
													<?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );  ?>
													<figure class="thumbnail" style="background:url('<?php echo $image[0]; ?>');"> 
														<a href="<?php the_permalink();?>"></a>
													</figure>	
												</div>
												
												<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> </h3>
												<div class="wrap_cmt_count">
													<div class="cat_post">
														<?php 
														$categories = get_the_category();
														$seperator = ", ";
														$output = '';
														if($categories){
															foreach ($categories as $category){
																$output .= '<a href="' . get_category_link($category->term_id) . '"> '. $category-> cat_name . ' </a>' .  $seperator;

															}
															echo trim($output , $seperator);
														}
														?>
														|   <span class="wpb-comment-count"><b><?php the_time('d/m/y');?></b><a href="<?php the_permalink();?>"></a></span>
													</div>
													
												</div>


												<div class="excerpt">
													<p><?php echo excerpt(50); ?></p>
												</div>
											</div>

										</li>
									<?php endwhile; ?>
								<?php endif; ?> 
							</ul>
						</div>
					</div>
				</div>
				<div class="list_post_highlight">
					<div class="container">
						<h2 class="title_tg_top">Bài viết nổi bật nhất</h2>
						<div class="row">
							<?php 
							$arg_cmt_post_q = array(
								'posts_per_page' => 4,
								'meta_key' => 'wpb_post_views_count',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',
								'post_type' => 'post',
								'post_status' => 'publish'
							);
							$cmt_post_q = new WP_Query();
							$cmt_post_q->query($arg_cmt_post_q);
							?>
							<?php if(have_posts()) : ?>
								<ul>
									<?php
									while ($cmt_post_q->have_posts()) : $cmt_post_q->the_post(); ?>
										<li>
											<div class="post_cmt_wrapper pw">
												<div class="wrap_thumb">
													<?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );  ?>
													<figure class="thumbnail" style="background:url('<?php echo $image[0]; ?>');"> 
														<a href="<?php the_permalink();?>"></a>
													</figure>	
												</div>
												<div class="cat_post">
													<?php 
													$categories = get_the_category();
													$seperator = ", ";
													$output = '';
													if($categories){
														foreach ($categories as $category){
															$output .= '<a href="' . get_category_link($category->term_id) . '"> '. $category-> cat_name . ' </a>' .  $seperator;

														}
														echo trim($output , $seperator);
													}
													?>
												</div>
												<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> </h3>
										
												<div class="post_meta">
													<span class="author_post"> 
														<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
															<?php echo get_avatar(get_the_author_meta('ID')); ?>
															<?php the_author(); ?>
														</a> 
													</span>

												</div>
												<div class="excerpt">
													<p><?php echo excerpt(50); ?></p>
												</div>
											</div>

										</li>
									<?php endwhile; ?>
								<?php endif; ?> 
							</ul>
						</div>
					</div>
				</div>

				<div class="focal_week">
					<div class="lb_focal_week">
						Tin tức hot
					</div>
					<?php 
					$arg_focal_week = array(
						'posts_per_page' => 5,
						'cat' => 7,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish'
					);
					$focal_week_query = new WP_Query();
					$focal_week_query->query($arg_focal_week);
					?>
					<ul>
						<?php if(have_posts()) : 
							while($focal_week_query->have_posts()) : $focal_week_query->the_post();
								?>
								<li class="item_focal_week pw">
									<figure class="thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a> </figure>
									<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
								</li>
								<?php  
							endwhile;
						else:
						endif;
						?>
					</ul>
				</div>

			</div><!-- content_left -->
		</div> 	<!-- container -->
	</div>
	
</div>
</div>
<?php get_footer(); ?>
