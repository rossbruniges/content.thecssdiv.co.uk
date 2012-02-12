<?php global $linen; ?>
<div id="featured" class="clear">
	<div class="container">
		<div id="slides">
			<div class="slides_container">
				<?php query_posts(array( 'post__in'=>get_option( 'sticky_posts' ))); ?>
				<?php $count_1 = 0; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); $count_1++; ?>
					<div id="slide-<?php echo $count_1; ?>" class="slide">
						<?php if ( has_post_thumbnail() ) : 
							the_post_thumbnail( 'featured', array( 'class' => 'feature-photo' ));
						endif; ?>
						<div class="slide-content">
							<h3><?php the_title(); ?></h3>
							<?php echo $linen->customContent(35); ?>
						</div>
					</div>
				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>
			</div>
			<a href="#" class="prev"><img src="<?php echo get_template_directory_uri(); ?>/images/featured-arrow-prev.png" width="20" height="40" alt="Arrow for previous featured post"></a>
			<a href="#" class="next"><img src="<?php echo get_template_directory_uri(); ?>/images/featured-arrow-next.png" width="20" height="40" alt="Arrow for next featured post"></a>
		</div>
	</div>
</div><!--end featured-->