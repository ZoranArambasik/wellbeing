<?php 
/*
Template Name: Evaluation Forms
*/ 
get_header(); ?>
    <div class="pages pages-evaluate-forms" style="background: <?php echo get_field('background_color'); ?>">
        <div class="container" style="position:relative;">
            <?php 
                $main_image = get_field('background_image');
                if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <div class="evaluate-form-title" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?>
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="postentry-content">        
                        <?php 
                                
                        ?>     
                        <?php the_content(); ?>
                        <?php //$get = FrmProEntriesController::get_field_value_shortcode(array('field_id' => 15, 'user_id' => 'current')); var_dump($get); ?>
                    </div>
                </div>       
                <?php endwhile; else: ?>
                <div class="post">
                    <h2 class="posttitle"><?php _e('Not Found', 'Wellbeing') ?></h2>
                    <div class="postentry"><p><?php _e('Sorry, no posts matched your criteria.', 'Wellbeing'); ?></p></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php wp_footer(); ?>