<?php 
/*
Template Name: Edit your business
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php if (is_user_logged_in()) {
	global $current_user;                     
	$current_user_id = get_current_user_id(); ?>
		
		<main class="content">
			<div class="pages edit-your-business">
			<div class="container">
				<?php if (have_posts()) { 
					while (have_posts()) : the_post(); ?>
				<?php 
					$args = array(
					  'author'        =>  $current_user->ID, 
					  'orderby'       =>  'post_date',
					  'post_type' 	=>    'company',
					  'order'         =>  'ASC',
					  'posts_per_page' => 1,
					  'post_status' => 'any'
					);
					$current_user_posts = get_posts( $args ); ?>

					<article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
						<h2 class="page-title"><?php _e('Welcome', 'Wellbeing'); echo ' ' . $current_user_posts[0]->post_title; ?></h2>
						<h4 class="page-title"><?php echo get_the_title(); ?></h4>
							<?php
							// $current_user_drafts = get_users_drafts($current_user->ID);
							// var_dump($current_user_posts[0]->ID);
								acf_form([
									'field_groups' => [2820, 379, 5867, 348],
									//'post_id' => 'user_' . $current_user_id,
									'post_id' => $current_user_posts[0]->ID,
									'html_submit_button' => '<button type="submit" class="acf-button button button-primary button-large" value="Update Profile">' . __("Update Business", "Wellbeing") . '</button>',
									'updated_message' => __('User profile updated.', 'txtdomain')
							]);
						?>
					</article>
				<?php endwhile;
				} ?>
		</div>
	</div>
</main>
<?php } else {  // wp_redirect(home_url('/account')); exit; ?>
	<main class="content">
		<div class="pages edit-your-business">
			<div class="container">
				<div class="go_to_login">
	        		<?php _e('Please', 'Wellbeing'); ?> <a href="<?php echo home_url('/login'); ?>"> <u><?php _e('login', 'Wellbeing'); ?></u></a> <?php _e('or', 'Wellbeing'); ?> <a href="<?php echo home_url('/register') ?>"> <u><?php _e('register', 'Wellbeing'); ?></u></a>!
	    		</div>
			</div>
		</div>
	</div>
<?php }
get_sidebar();
get_footer();