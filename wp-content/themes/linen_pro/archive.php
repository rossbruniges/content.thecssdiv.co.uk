<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php the_post(); ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h1 class="pagetitle"><?php printf(__( 'Posts from the  &#8216;%s&#8217; Category', 'linen' ), single_cat_title('', false)); ?></h1>
		<?php /* If this is a tag archive */ } elseif ( is_tag() ) { ?>
			<h1 class="pagetitle"><?php printf(__( 'Posts tagged &#8216;%s&#8217;', 'linen' ), single_tag_title('', false)); ?></h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1 class="pagetitle"><?php printf( __( 'Archive for %s', 'linen' ), get_the_time(  'F jS, Y', 'linen' ) ); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1 class="pagetitle"><?php printf( __( 'Archive for %s', 'linen' ), get_the_time(  'F, Y', 'linen' ) ); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="pagetitle"><?php printf( __( 'Archive for %s', 'linen' ), get_the_time(  'Y', 'linen' ) ); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h1 class="pagetitle"><?php printf(__( 'Posts by %s', 'linen' ), get_the_author() ); ?></h1>
		<?php /* If this is a paged archive */ } elseif ( is_paged() ) { ?>
			<h1 class="pagetitle"><?php _e( 'Blog Archives', 'linen' ); ?></h1>
		<?php } ?>
	<?php rewind_posts(); ?>
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
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>