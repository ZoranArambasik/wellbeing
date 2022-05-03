<?php get_header(); ?>
<div class="singles-image">
    <?php 
    $term = get_queried_object();
    $img = get_field('c_category_header_image', $term); ?>
    
    <?php if (!empty($img)): ?>
        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="slider-text">
            <div class="small-text"><?php echo get_field('description_inside_header', $term);  ?></div>
        </div>
    </div>
</div>
<div class="pages">
    <div class="tax-country-top-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php echo get_field('description_below_country', $term); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="routs-main-content">
        <div class="container">
            <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php global $post; ?>
                <div class="col-md-6 p-2" id="post-<?php the_ID(); ?>"> 
                    <div class="places-holder-post">
                        <a class="show-hover-excerpt" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <div class="content-places-holder">
                                <?php 
                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( get_the_ID() ) ));
                                 // var_dump($taxonomies);
                                 foreach ($taxonomies as $taxonomy) {
                                     // var_dump($taxonomy);
                                     $terms = get_the_terms( $post->ID, $taxonomy );;
                                     if (!empty($terms)) {
                                         foreach ($terms as $term) {
                                             $image = get_field('add_tax_icon', $term);
                                             if (!empty($image)) {
                                                 echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                             }       
                                         } 
                                     }  
                                 }
                                ?>
                                <h3><?php the_title(); ?></h3>
                                <?php if (get_field('small_description_home_page', $post->ID)): ?>
                                <p class="display-hover">
                                    <span class="show-excerpt"><?php echo get_field('small_description_home_page', $post->ID); ?></span>
                                </p>
                                <?php endif; ?>
                                <span class="arrow-go-places lnr lnr-chevron-right"></span>
                            </div>
                           
                            
                        </a>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif;  ?>
            </div>
            <?php
            $term = get_queried_object();
            $link2 = get_field('show_all_link_url', $term);
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
<?php get_footer() ?>