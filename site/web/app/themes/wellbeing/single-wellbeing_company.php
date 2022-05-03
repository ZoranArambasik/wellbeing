<?php get_header() ?>
<div class="slide-image-and-text">
<div class="slide-images">
  <div class="header-image">
      <?php echo has_post_thumbnail() ? get_the_post_thumbnail() : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
      <div class="container">
          <div class="slider-text">
              <div class="small-text">
                <h1><?php echo get_field('featured_image_title'); ?></h1>
                <p><?php echo get_field('featured_image_description'); ?></p>
              </div>
          </div>
      </div>
  </div> 
</div>
<img class="lotus-bottom" src="<?php bloginfo('template_directory') ?>/images/Lotus.png">
</div>
  <div class="wellbeing-single-pages">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mt-5">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="wellbeing_company_post_holder" id="post-<?php the_ID(); ?>">   
                    <div class="postentry">             
                        <div class="post-text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>       
                <?php endwhile; ?>
               <?php $next_post = get_previous_post();
                if($next_post) {
                   $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                   echo '<h4 class="next-wb-post">'; ?>
                    <span><?php _e('NEXT', 'Wellbeing'); ?></span>
                      <?php echo ': <a rel="prev" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class=" ">'. $next_title . '</a>';
                    echo  '</h4>';
                } ?>
            <?php endif; ?>
            </div>
            <div class="col-md-5 p-0 sidebar-wellbeing-singles">
             <?php include get_theme_file_path('includes/wellbeing-posts-sidebar.php'); ?>
            </div>
        </div>
      </div>
    </div>
<?php get_footer() ?>