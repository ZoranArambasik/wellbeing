<?php 
/*
Template Name: About us
*/ 
get_header() ?>
    <div class="about-us">
        <?php 
            if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
              <div class="get-page-thumb" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?>
                <div class="container">
                  <div class="small-text about-small-text">
                    <h1><?php the_title(); ?></h1>
                  </div>
                </div>
                <img class="lotus-bottom" src="<?php bloginfo('template_directory') ?>/images/Lotus.png">
              </div>
              <div class="postentry-content">             
                  <?php the_content(); ?>
              </div>
            </div>       
            <?php endwhile; else: ?>
            <div class="post">
                <h2 class="posttitle"><?php _e('Not Found', 'Wellbeing') ?></h2>
                <div class="postentry"><p><?php _e('Sorry, no posts matched your criteria.', 'Wellbeing'); ?></p></div>
            </div>
        <?php endif; ?>    
    </div>
<?php get_footer() ?>