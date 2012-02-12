<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<h1 class="pagetitle"><?php printf( __("Search results for '%s'", "linen"), get_search_query()); ?></h1>
	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>
			<div class="post-date-box <?php if ( !has_post_thumbnail() ) echo 'no-thumb'; ?>">
				<div class="post-date">
					<p><?php the_time( __( 'M j', 'linen' ) ); ?></p>
				</div>
				<?php if ( has_post_thumbnail() ) the_post_thumbnail( 'index-thumb' ); ?>
					<div class="post-comments">
						<?php comments_popup_link( '',  __( '1 Comment', 'linen' ), _n ( '% Comments', '% Comments', get_comments_number (), 'linen' )); ?>
					</div>
			</div>
			<div class="entry">
				<h2 class="title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( __('Permanent Link to %s', 'linen' ), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a>
				</h2>
				<?php the_content( __( 'Read more', 'linen' )); ?>
				<?php edit_post_link(__( 'Edit', 'linen' )); ?>
			</div><!--end entry-->
		</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="navigation index">
			<?php if ( function_exists( 'wp_pagenavi' ) ) :
				wp_pagenavi(); ?>
			<?php else : ?>
				<div class="alignleft"><?php next_posts_link(__ ( '&laquo; Older Entries', 'linen' )); ?></div>
				<div class="alignright"><?php previous_posts_link(__ ( 'Newer Entries &raquo;', 'linen' )); ?></div>
			<?php endif; ?>
		</div><!--end navigation-->
<?php else : ?>
	<h1 class="pagetitle"><?php printf( __("Search results for '%s'", "linen"), get_search_query()); ?></h1>
	<div class="entry no-results">
		<p><?php printf( __( 'Sorry your search for "%s" did not turn up any results. Please try again.', 'linen' ), get_search_query());?></p>
		<?php get_search_form(); ?>
	</div><!--end entry-->
<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
