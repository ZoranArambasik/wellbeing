<?php 
/*
Template Name: Evaluation Forms results
*/
if (is_user_logged_in()) {
    // global $current_user; 
    // var_dump($current_user);                    
    $current_user_id = get_current_user_id();
    $page_id = get_queried_object_id();
    get_header(); ?>

    <div class="slide-images">
      <div class="header-image">
          <?php echo has_post_thumbnail() ? get_the_post_thumbnail() : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
          <div class="container">
              <div class="slider-text">
                  <div class="small-text">
                    <h1 class="text-white"><?php _e('Self Evaluation Scores','Wellbeing'); ?></h1>
                  </div>
              </div>
          </div>
      </div> 
    </div>
    
    <main class="content">
        <div class="pages pages-evaluate-forms edit-your-business">
            <div class="container">
                <div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
                    <div class="evaluation-page">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-7 mt-3">
                              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                  <div class="" id="post-<?php the_ID(); ?>">   
                                      <div class="postentry">             
                                          <div class="post-text">
                                            <div class="evaluate-form-title" title="<?php the_title_attribute(); ?>">
                                                <?php $image = get_field('image_next_to_title'); ?>
                                                <?php if ($image): ?>
                                                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                <?php endif; ?>
                                                <h2><?php the_title(); ?></h2>
                                            </div>
                                            <div class="eval-results">
                                              <?php the_content(); ?>
                                                
                                            </div>
                                          </div>
                                      </div>
                                  </div>       
                                  <?php endwhile; ?>
                              <?php endif; wp_reset_query(); ?>
                            </div>
                            <div class="col-md-5 pt-5 sidebar-wellbeing-singles">
                              <?php 
                                $args = array(
                                    'post_type' => 'page',
                                    'post__not_in'    => array($page_id),
                                    'meta_key' => '_wp_page_template',
                                    'meta_value' => 'evaluation-form-results.php'
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) : ?> 
                                  <h6 class="font-weight-bold"><?php _e('Your other tests', 'Wellbeing') ?></h6>
                                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <?php $bgcolor = get_field('background_button_color'); ?>
                                    <div class="page-color" style="background-color:<?php echo $bgcolor; ?>">
                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                <?php endwhile; ?>
                                <?php endif; ?>
                                
                            </div>
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