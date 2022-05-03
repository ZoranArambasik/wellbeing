<?php 
get_header(); ?>
<!-- START POPUP -->
<?php  
$args = array( 
    'posts_per_page' => 1,
    'post_type' => 'popup'
  
 );

$the_query = new WP_Query( $args );
if ($the_query->have_posts()) : ?>
    <div class="modal fade" id="myModal">
       <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
           <div class="popup-main">
               <div class="popup-img-title">
                   <?php the_post_thumbnail(); ?>
                   <h2 class="popup-title"><?php the_title(); ?></h2>
               </div>
                <div class="container">
                    <div class="popup-holder">
                        <div class="popup-content"><?php the_content(); ?></div>
                        <div class="popup-buttons">
                            <?php
                            $link1 = get_field('popup_button_one', $the_query->ID);
                            if( $link1 ): 
                                $link_url = $link1['url'];
                                $link_title = $link1['title'];
                                $link_target = $link1['target'] ? $link1['target'] : '_self';
                            ?>
                                <a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                            <?php endif; ?>
                            <?php
                            $link2 = get_field('popup_button_two', $the_query->ID);
                            if( $link2 ): 
                                $link_url = $link2['url'];
                                $link_title = $link2['title'];
                                $link_target = $link2['target'] ? $link2['target'] : '_self';
                            ?>
                                <a class="classic-url-pink" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>              
        <?php endwhile; ?>
    </div>
<?php endif; ?>
<!-- END POPUP -->
    <div class="pages">
        <?php 
            if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="get-page-thumb" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?>
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