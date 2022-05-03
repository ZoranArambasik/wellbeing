<?php 
/*
Template Name: Register
*/ 
get_header(); ?>
<div class="slide-images">
    <div class="header-image">
        <?php the_post_thumbnail(); ?>
        <div class="container">
            <div class="slider-text">
                <div class="small-text">
                  <h1 class="text-white"><?php the_title(); ?></h1>
                 
                </div>
            </div>
        </div>
    </div> 
</div>
  <div class="wellbeing-single-pages">
      <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="" id="post-<?php the_ID(); ?>">   
                    <div class="postentry">             
                        <div class="post-text">
                          <?php if (is_user_logged_in()) { ?>
                            <p class="already-reg"><?php _e('You are already registered.', 'Wellbeing'); ?></p>
                          <?php } else { ?>
                            <?php the_content(); ?>
                          <?php } ?>
                        </div>
                    </div>
                </div>       
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
            <div class="col-md-5 p-0 sidebar-wellbeing-singles">
             <?php include get_theme_file_path('includes/register-sidebar.php'); ?>
            </div>
        </div>
      </div>
    </div>
<?php get_footer() ?>