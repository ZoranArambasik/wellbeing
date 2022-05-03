
<?php if (is_user_logged_in()) {
	global $current_user;                     
	$current_user_id = get_current_user_id(); ?>

	<?php 
		$args = array(
		  'author'        =>  $current_user->ID, 
		  'orderby'       =>  'post_date',
		  'post_type' 	=>    'company',
		  'order'         =>  'ASC',
		  'posts_per_page' => 1,
		  'post_status' => 'any'
		);
		$current_user_posts = get_posts( $args ); 
		$post_user_status = $current_user_posts[0]->post_status;
		$post_user_id = $current_user_posts[0]->ID;
		$main_header_image_companies = get_field('main_header_image_companies', $post_user_id);
		$post_user_url = $current_user_posts[0]->post_name;
		$post_user_type = $current_user_posts[0]->post_type;
		?>
		


<div class="sign-up-section-holder reg-sidebar">
    <h4><?php _e( 'How it works', 'Wellbeing' ); ?></h4>

    <div class="hiw-holder company-logged-in">
	    <h5><span>1. <?php _e( 'Sign up & create free account', 'Wellbeing' ); ?></span> <span><img src="<?php bloginfo('template_directory') ?>/images/checkmark.png"></span></h5>
	    <p><?php _e( 'Create a username and password', 'Wellbeing' ); ?></p>
	</div>

	<div class="hiw-holder company-logged-in">
	    <h5><span>2. <?php _e( 'Confirm your account', 'Wellbeing' ); ?></span> <span><img src="<?php bloginfo('template_directory') ?>/images/checkmark.png"></span></h5>
	    <p><?php _e( 'You will recieve an email to confirm your adress', 'Wellbeing' ); ?></p>
	</div>
	<?php if ($post_user_status == 'publish'): ?>
		<div class="hiw-holder company-logged-in">
		    <h5><span>3. <?php _e( 'Evaluate your business', 'Wellbeing' ); ?></span> <span><img src="<?php bloginfo('template_directory') ?>/images/checkmark.png"></span></h5>
		    <p><?php _e( 'Anwer questioins regarding your Wellbeing status as a company', 'Wellbeing' ); ?></p>
		</div>
	<?php else: ?>
		<div class="hiw-holder">
		    <h5>3. <?php _e( 'Evaluate your business', 'Wellbeing' ); ?></h5>
		    <p><?php _e( 'Anwer questioins regarding your Wellbeing status as a company', 'Wellbeing' ); ?></p>
		</div>
	<?php endif ?>
	<?php if ($main_header_image_companies && $post_user_status == 'publish'): ?>
		<div class="hiw-holder company-logged-in">
		    <h5><span>4. <?php _e( 'Upload images and enter more information about your company', 'Wellbeing' ); ?></span> <span><img src="<?php bloginfo('template_directory') ?>/images/checkmark.png"></span></h5>
		    <a class="ml-0 classic-url-pink with-border-white" href="<?php echo home_url($post_user_type . '/' . $post_user_url); ?>"><?php _e('Show my profile', 'Wellbeing') ?></a>
		</div>
		<div class="hiw-holder company-logged-in">
		    <h5><span>5. <?php _e( 'All done, your business is now available on the map', 'Wellbeing' ); ?></span> <span><img src="<?php bloginfo('template_directory') ?>/images/checkmark.png"></span></h5>
		</div>
	<?php else: ?> 
		<div class="hiw-holder">
		    <h5>4. <?php _e( 'Upload images and enter more information about your company', 'Wellbeing' ); ?></h5>
		    <a class="ml-0 classic-url-pink with-border-white disable-click" href="<?php echo home_url('/account'); ?>"><?php _e('Show my profile', 'Wellbeing') ?></a>
		</div>
		<div class="hiw-holder">
		    <h5>5. <?php _e( 'All done, your business is now available on the map', 'Wellbeing' ); ?></h5>
		</div>
	<?php endif ?>

	

	

</div>



<div class="wellbeing-posts-menu">
  <?php 
   $custom_terms = get_terms('wellbeing_company_categories');
   foreach($custom_terms as $custom_term) {
       wp_reset_query();
       $args = array('post_type' => 'wellbeing_company',
           'tax_query' => array(
               array(
                   'taxonomy' => 'wellbeing_company_categories',
                   'field' => 'slug',
                   'terms' => $custom_term->slug,
               ),
           ),
        );

        $loop = new WP_Query($args); 
        echo "<div class='wb-cat-holder'>";
        if($loop->have_posts()) {
           echo '<h4 class="wb-cat-title">'.$custom_term->name.'</h4>';

           while($loop->have_posts()) : $loop->the_post();
               echo '<p><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
           endwhile;
        }
        echo "</div>";
   }

  ?>
 </div>
<?php } else { ?> 

<div class="sign-up-section-holder reg-sidebar">
    <h4><?php _e( 'How it works', 'Wellbeing' ); ?></h4>
    <div class="hiw-holder">
	    <h5>1. <?php _e( 'Sign up & create free account', 'Wellbeing' ); ?></h5>
	    <p><?php _e( 'Create a username and password', 'Wellbeing' ); ?></p>
	</div>
	<div class="hiw-holder">
	    <h5>2. <?php _e( 'Confirm your account', 'Wellbeing' ); ?></h5>
	    <p><?php _e( 'You will recieve an email to confirm your adress', 'Wellbeing' ); ?></p>
	</div>
	<div class="hiw-holder">
	    <h5>3. <?php _e( 'Evaluate your business', 'Wellbeing' ); ?></h5>
	    <p><?php _e( 'Anwer questioins regarding your Wellbeing status as a company', 'Wellbeing' ); ?></p>
	</div>
	<div class="hiw-holder">
	    <h5>4. <?php _e( 'Upload images and enter more information about your company', 'Wellbeing' ); ?></h5>
	</div>
	<div class="hiw-holder">
	    <h5>5. <?php _e( 'If you pass the evaluation tests, your locating is now shown on the atlas. ', 'Wellbeing' ); ?></h5>
	</div>
</div>

<?php } ?>
