 <?php 
 if ( !is_user_logged_in() ) { ?>
    <div class="sign-up-section-holder">
    <?php
      if ( is_active_sidebar( 'sign-up-section' ) ) : 
        dynamic_sidebar( 'sign-up-section' ); 
      endif; 
     ?>
     <a class="ml-0 classic-url-pink with-border-white" href="<?php echo home_url('/register'); ?>" target="_self"><?php _e('Sign up', 'Wellbeing'); ?></a>
 </div>
 <?php } ?>
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