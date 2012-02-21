<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'single' ); ?>>
				<h1 class="single-post-title"> <?php the_title(); ?></h1>
				<div class="single-post-meta">
					<?php printf( __( 'by %s on', 'linen' ), get_the_author()); ?> <?php the_date(); ?>
				</div>
                <?php if (date('Y') - get_the_date('Y') >= 2) : ?>
                <div class="alert">
                <p><strong>Old content alert!</strong></p>
                <p>Thanks very much for visiting my blog. Always happy to have people read my stuff but just thought I should point out this post is years old. If it's about technical stuff there is a possibility that it is no longer relevant, if it's a bug report/fix I'm hoping that it should now have been fixed.</p>
                <p>Of course if this is what you're looking for and it does work then great, just don't say I didn't warn you...</p>
                </div>
                <?php endif; ?>
				<div class="entry single clear">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'medium', array( 'class' => 'single-post-thm alignleft' ) );
					} ?>
					<?php the_content(); ?>
					<?php edit_post_link( __( 'Edit this', 'linen' ), '<p>', '</p>' ); ?>
					<?php wp_link_pages(); ?>
				</div><!--end entry-->
				<div class="post-footer clear">
					<div class="tags">
						<?php the_tags( 'Tags: ', ', ', '' ); ?>
					</div>
					<div class="cats">
						<?php printf( __( 'From: %s', 'linen' ), get_the_category_list( ', ' ) ); ?>
					</div>
				</div><!--end post footer-->
			</div><!--end post-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<?php comments_template( '', true); ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
