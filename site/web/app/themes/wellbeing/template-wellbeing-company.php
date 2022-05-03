<?php 
/*
Template Name: Wellbeing Company Introduction
*/ 
get_header() ?>
    <div class="pages">
        <?php 
            if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="postentry-content">             
                    <?php the_content(); ?>
                </div>
            </div>       
            <?php endwhile; 

            endif; ?>  

            <?php  
            $args = array( 
                'posts_per_page' => 5,
                'post_type' => 'wellbeing_company'
              
             );
            $the_query = new WP_Query( $args );?>

            <div class="wellbeing-company-holder">
                <div class="container">
                  <div class="row">
                    <div class="col-md-7 mt-5">
                      <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                          <div class="wb-inner-holder" id="post-<?php the_ID(); ?>">      
                                <div class="wellbeing-company-inner">
                                    <div class="wellbeing-company-image"><?php the_post_thumbnail(); ?></div>
                                    <div class="wellbeing-company-text">
                                      <h3><?php the_title(); ?></h3>
                                      <?php echo excerpt(40); ?>
                                      <a class="classic-url-orange" href="<?php the_permalink(); ?>"><?php _e('Learn more', 'Wellbeing'); ?></a>
                                      </div>
                                </div>
                          </div>       
                          <?php endwhile; ?>
                      <?php endif; ?>
                      </div>
                      <div class="col-md-5 p-0 sidebar-wellbeing-singles">
                       <?php include get_theme_file_path('includes/wellbeing-posts-sidebar.php'); ?>
                      </div>
                  </div>
                </div>
            </div>

    </div>
<?php get_footer() ?>