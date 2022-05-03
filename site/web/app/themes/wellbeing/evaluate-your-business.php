<?php 
/*
Template Name: Evaluate your business
*/
if (is_user_logged_in()) {
	// global $current_user; 
	// var_dump($current_user);                    
	$current_user_id = get_current_user_id();
	get_header(); ?>

	<div class="slide-images">
	  <div class="header-image">
	      <?php echo has_post_thumbnail() ? get_the_post_thumbnail() : '<img src="' . get_bloginfo( 'template_directory' )  . '/images/no-image.jpg" />'; ?>
	      <div class="container">
	          <div class="slider-text">
	              <div class="small-text">
	                <h1 class="text-white"><?php the_title(); ?></h1>
	               
	              </div>
	          </div>
	      </div>
	  </div> 
	</div>
	
	<main class="content">
		<div class="pages edit-your-business">
			<div class="container">
					<div class="evaluation-page">
					    <div class="container">
					      <div class="row">
					        <div class="col-md-7 mt-3">
					          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					              <div class="" id="post-<?php the_ID(); ?>">   
					                  <div class="postentry">             
					                      <div class="post-text">
					                      	<h2><?php _e('Welcome', 'Wellbeing'); ?> <?php echo $current_user->user_login; ?></h2>
					                          <?php the_content(); ?>
					                      </div>
					                  </div>
					              </div>       
					              <?php endwhile; ?>
					          <?php endif; ?>
					          <div class="">
					          	<?php
					          	$terms = get_terms( array( 
					          	    'taxonomy' => 'main_category'
					          	) );
	                            if (!empty($terms)) { 
	                                foreach ($terms as $term) { 
	                                	$tax_main_image = get_field('background_image', $term);
	                                    $tax_main_icon = get_field('add_tax_icon', $term); 
	                                    $tax_description = get_field('main_category_description', $term);
	                                    $background_color_of_description = get_field('background_color_of_description', $term);
	                                    $add_form_url = get_field('add_form_url', $term);
	                                    ?>

	                                    <div class="evaluation-page-category-holder">
			                            	<div class='background-image-main-category'>

			                                    <?php if ($tax_main_image) { ?>
			                                        <img src="<?php echo esc_url($tax_main_image['url']); ?>" alt="<?php echo esc_attr($tax_main_image['alt']); ?>" />
			                                    <?php } else { ?>
			                                    	<img src="<?php bloginfo('template_directory') ?>/images/no-image.jpg"/>
			                                    <?php } ?>
			                                    <?php if ($tax_main_icon): ?>
		                                    		<div class="tax-img-holder-evaluation">
		                                    			<img src="<?php echo $tax_main_icon; ?>" alt="<?php echo $term->name; ?>" />
		                                    		</div>
			                                    <?php endif ?>
			                                </div>
		                                	<div class="main-category-description" style="background-color: <?php echo $background_color_of_description; ?>">
		                                		<h3><?php echo $term->name; ?></h3>
				                                <?php if ($tax_description): ?>
			                                		<?php echo $tax_description; ?>
				                                <?php endif; ?>

		                                		<?php
		                                		if ($add_form_url) {
		                                			$link_url = $add_form_url['url'];
		                                		    $link_title = $add_form_url['title'];
		                                		    $link_target = $add_form_url['target'] ? $add_form_url['target'] : '_self'; ?>
		                                		    <a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_attr( $link_title ); ?></a>
		                                		<?php } ?>
		                                		    
		                                		
		                                	</div>
			                            </div>
	                               <?php } 
	                            }
	                            ?>
					          </div>
				          	</div>
							<div class="col-md-5 p-0 sidebar-wellbeing-singles">
								<?php include get_theme_file_path('includes/register-sidebar.php'); ?>
							</div>
					      </div>
					    </div>
					  </div>

			</div>
		</div>
	</main>
	<?php get_footer(); 
} 
else {
	header('Location:' . get_bloginfo('url') . '/register');
}