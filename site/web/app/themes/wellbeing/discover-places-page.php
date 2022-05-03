<?php 
/*
Template Name: Discover Places
*/ 
get_header() ?>
    <div class="pages setup-results">
        <div class="row no-gutters min-hundred">
            <div class="col-lg-4 col-results">
                <div class="results-inner">
                    <?php echo do_shortcode('[searchandfilter id="323"]') ?>
                </div>
            </div>
            <div id="main-results" class="col-lg-8">
                <?php echo do_shortcode('[searchandfilter id="323" show="results"]') ?>
            </div>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="get-page-thumb" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?>
                </div>
                <div class="postentry-content">             
                    <?php the_content(); ?>
                </div>
            </div>       
            <?php endwhile; else: ?>
            <div class="post">
                <h2 class="posttitle"><?php _e('Not Found', 'Wellbeing'); ?></h2>
                <div class="postentry"><p><?php _e('Sorry, no posts matched your criteria.', 'Wellbeing'); ?></p></div>
            </div>
        <?php endif; ?>    
    </div>
<script src="https://maps.googleapis.com/maps/api/js?key=xxx"></script>
<?php get_footer(); ?>