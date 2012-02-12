<?php global $linen; ?>
<div class="subscribe clear">
	<?php if ($linen->followDisable() != 'true' ) { ?>
		<h2 class="widgettitle"><?php _e( 'Subscribe', 'linen' ); ?></h2>
		<ul>
			<?php if ($linen->facebookToggle() == 'true' ) { ?>
				<li>
					<a href="<?php echo $linen->facebook(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/flw-facebook.png" alt="<?php _e( 'Facebook', 'linen' ); ?>"/></a>
				</li>
			<?php } ?>
			<?php if ($linen->flickrToggle() == 'true' ) { ?>
				<li>
					<a href="<?php echo $linen->flickr(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/flw-flickr.png" alt="<?php _e( 'Flickr', 'linen' ); ?>"/></a>
				</li>
			<?php } ?>
			<?php if ($linen->twitterToggle() == 'true' ) { ?>
				<li>
				 <a href="http://twitter.com/<?php echo $linen->twitter(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/flw-twitter.png" alt="<?php _e( 'Twitter', 'linen' ); ?>"/></a>
				</li>
			<?php } ?>
			<li>
				<a href="<?php bloginfo( 'rss2_url' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/flw-rss.png" alt="<?php _e( 'RSS Feed', 'linen' ); ?>"/></a>
			</li>
		</ul>
	<?php } ?>
</div>