<?php 
/*
Template Name: Member Page
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
  <div class="pages wellbeing-account-page pt-4 pb-5">
      <div class="container">
        <div class="row">
            <div class="col-md-7 mt-5">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
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