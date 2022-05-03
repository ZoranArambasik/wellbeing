<?php

/**
 * Download PDF with image and text Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'download-pdf-image-text' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'download-pdf-image-text';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if ('image_text_download_file'): ?>
        <?php while(have_rows('image_text_download_file')) : the_row(); ?>
            <?php
                $img = get_sub_field('image'); 
                $title = get_sub_field('title'); 
                $description = get_sub_field('description');
                $file = get_sub_field('button');
                $link = get_sub_field('another_link');
                $link_two = get_sub_field('add_link_two');
            ?>
            <?php if ($img || $title || $description || $file): ?>
                <div class="col-12 ln-more-pink">
                    <div class="row">
                        <?php if (!empty($img)): ?>
                            <div class="image-aditional-holder"><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" /></div>
                        <?php endif; ?>
                        <div class="sm-padding">
                            <?php if ($title): ?>
                                <h3 class="smaller-h3"><?php echo $title; ?></h3>
                            <?php endif ?>
                            <?php if ($description): ?>
                                <div class=""><?php echo $description; ?></div>
                            <?php endif ?>
                            <div class="buttons-inline">
                                <?php
                                if( $file ): ?>
                                    <a class="classic-url-orange" target="_blank" href="<?php echo $file['url']; ?>"><?php _e('Download', 'Wellbeing'); ?></a>
                                <?php endif; ?>
                                <?php if ($link): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                    <a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                                <?php if ($link_two): 
                                    $link_url = $link_two['url'];
                                    $link_title = $link_two['title'];
                                    $link_target = $link_two['target'] ? $link_two['target'] : '_self'; ?>
                                   <a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>   
    <?php endwhile; ?>
<?php endif; ?>