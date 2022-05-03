<?php get_header() ?>
   <div class="pages container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">   
                <div class="postentry">             
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
                    <div class="post-text">
                        <h1 class="posttitle"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
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