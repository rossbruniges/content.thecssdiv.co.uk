<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
	<?php query_posts( 'showposts=25' ); ?>
	<?php if (have_posts()) : ?>
		<h1 class="pagetitle"><?php bloginfo( 'title' ); ?> <?php _e( 'Archives', 'linen' ); ?></h1>
		<div class="entry">
			<h2><?php _e( 'Recent Posts', 'linen' ); ?></h2>
		</div><!--end-entry-->
		<div class="entries">
			<ul>
				<?php while (have_posts()) : the_post(); ?>
					<li class="clear">
						<span><?php the_time( get_option( 'date_format' ) ); ?></span>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
					</li>
				<?php endwhile; endif; ?>
			</ul>
		</div><!--end entries-->
		<div class="entry">
			<h2><?php _e( 'Monthly Archives', 'linen' ); ?></h2>
			<ul>
				<?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
			</ul>
		</div><!--end-entry-->
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>