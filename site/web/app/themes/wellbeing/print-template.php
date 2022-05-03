<?php 
/*
Template Name: Print
*/ 
wp_head();
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		setTimeout(function(){ window.print();  }, 1000);
	})
</script>
<div class="print-page">
	<div class="print-holder-logo"> 
		<img style="max-width: 200px;" src="/app/uploads/2021/12/logo-footer.png" alt="Logo">
		<img style="max-width: 300px;" src="<?php bloginfo('template_directory') ?>/images/eu-comp.jpg" alt="EU">
	</div>
	<?php
	$favorites = get_user_favorites();
	if ( isset($favorites) && !empty($favorites) ) : ?>
		<div class="print-holder">
			<?php foreach ( $favorites as $favorite ) : ?>
				<?php 
					$location = get_field('google_map', $favorite);
					$small_description = get_field('small_description_home_page', $favorite);
				?>
				<div class="row">
					<div class="col-6 mb-4 mt-5 pr-4">
						<div class="print-image"><?php echo get_the_post_thumbnail($favorite); ?></div>
					</div>
					<div class="col-5 mb-4 mt-5 pl-4">
					 	<div class="print-title"><h4><?php echo get_the_title($favorite); ?></h4></div>
					 	<div class="print-excerpt"><?php echo $small_description; ?></div>
					 	<div class="print-address"><?php echo $location['address']; ?></div>
					</div>
	 			</div>
			<?php endforeach; ?>
	 	</div>
	<?php endif; ?>
</div>
<style type="text/css">
	@media print {
	  .row {
	    break-inside: avoid;
	  }
	}
</style>
<?php wp_footer(); ?>