<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'about-us-members' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'about-us-members';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('about_us_members') ): ?>
<div class="about-members-section">
    <div class="container">
        <div class="row">
            <?php while ( have_rows('about_us_members') ) : the_row();
                while ( have_rows('member_fields') ) : the_row();
                $size_of_image = get_sub_field('size_appereance');
                $add_member_image = get_sub_field('add_member_image');
                $name_and_surname = get_sub_field('name_and_surname');
                $email = get_sub_field('email');
                $description = get_sub_field('description');

                ?>
                <?php if ($size_of_image == 'one-half'): ?>
                    <div class="p-2 col-sm-6 <?php echo esc_attr($className); ?>">
                <?php elseif ($size_of_image == 'one-forth'): ?>
                    <div class="p-2 col-lg-3 col-sm-6 <?php echo esc_attr($className); ?>">
                <?php else: ?>
                    <div class="p-2 col-12 <?php echo esc_attr($className); ?>">
                <?php endif; ?>
                    <?php if (!empty($add_member_image)): ?>
                        <div class="member-main-holder">
                            <div class="member-image"><img src="<?php echo esc_url($add_member_image['url']); ?>" alt="<?php echo esc_attr($add_member_image['alt']); ?>" /></div>
                            <div class="member-content">
                                <div class="member-name-email">
                                    <?php if ($name_and_surname): ?>
                                        <h5><?php echo $name_and_surname; ?></h5>
                                    <?php endif ?>
                                    <?php if ($email): ?>
                                        <p class="member-email"><i><?php echo $email; ?></i></p>
                                    <?php endif ?>
                                </div>
                                <?php if ($description): ?>
                                    <div class="member-description">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
           <?php endwhile; ?>
       </div>
    </div>
    <!-- <img class="lotus-bottom" src="<?php //bloginfo('template_directory') ?>/images/Lotus-red-medium.png"> -->
</div>
<?php endif; ?>
