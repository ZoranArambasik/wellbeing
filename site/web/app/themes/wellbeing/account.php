<?php 
/*
Template Name: Account
*/ 
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
    <?php endwhile; ?>
<?php endif; ?>
<?php 
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );


$parent = new WP_Query( $args );

?>
    <div class="pages wellbeing-account-page pt-5 pb-5">
      <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5">
                <?php if ($parent->have_posts()) : ?> 
                    <?php if (is_user_logged_in()): ?>
                            <div class="account-items-holder">
                                <?php while ($parent->have_posts()) : $parent->the_post(); ?>
                                <div class="classic-url-orange"><a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                <?php endwhile; ?>
                                <div class="classic-url-orange"><a href="<?php echo wp_logout_url(home_url('/login')); ?>"><?php _e('Logout', 'Wellbeing') ?></a></div>
                            </div>
                <?php else: ?>
                    <div class="go_to_login">
                        <?php _e('Please', 'Wellbeing'); ?> <a href="<?php echo home_url('/login'); ?>"> <u><?php _e('login', 'Wellbeing'); ?></u></a> <?php _e('or', 'Wellbeing'); ?> <a href="<?php echo home_url('/register') ?>"> <u><?php _e('register', 'Wellbeing'); ?></u></a>!
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            </div>
            <div class="col-md-5 p-0 sidebar-wellbeing-singles">
             <?php include get_theme_file_path('includes/register-sidebar.php'); ?>
            </div>
        </div>
      </div>
    </div>
<?php get_footer() ?>