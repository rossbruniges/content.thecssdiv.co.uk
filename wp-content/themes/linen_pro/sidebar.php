<?php global $linen; ?>
<?php if ($linen->sidebarDisable() != 'true' ) { ?>
	<div id="sidebar">
		<?php if ($linen->followDisable() != 'true' ) { ?>
			<?php get_template_part( 'tmpart-subscribe' ); ?>
		<?php } ?>
		<ul>
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'sidebar_1' ) ) : ?>
				<li class="widget widget_recent_entries">
					<h2 class="widgettitle"><?php _e( 'Recent Articles', 'linen' ); ?></h2>
					<?php $side_posts = new WP_Query( 'numberposts=10' ); ?>
					<?php if ( $side_posts->have_posts() ) : ?>
						<ul>
							<?php while( $side_posts->have_posts() ) : $side_posts->the_post(); ?>
								<li><a href= "<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		</ul>
	</div><!--end sidebar-->
<?php } ?>