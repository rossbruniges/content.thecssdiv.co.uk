<?php global $linen; ?>
</div><!--end wrapper-->
	<?php if ( $linen->footerDisable() != 'true' ) { ?>
		<div id="footer" class="clear">
			<div id="footer-1" class="footer-column">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_1') ) : ?>
					<h2 class="widgettitle"><?php _e( 'About Us' , 'linen' ); ?></h2>
					<p><?php _e( "Did you know you can write your own about section just like this one? It's really easy. Navigate to <code>Appearance &rarr; Widgets</code> and create a new Text Widget. Now move it to the Footer 1 sidebar." , "linen" ); ?></p>
					<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
				<?php endif; ?>
			</div>
			<div id="footer-2" class="footer-column">
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_2' ) ) : ?>
					<h2 class="widgettitle"><?php _e( 'Pages' , 'linen' ); ?></h2>
					<ul>
						<?php wp_list_pages( 'depth=1&title_li=' ); ?>
					</ul>
				<?php endif; ?>
			</div>
			<div id="footer-3" class="footer-column">
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_3' ) ) : ?>
					<h2 class="widgettitle"><?php _e( 'Categories', 'linen' ); ?></h2>
					<ul>
						<?php wp_list_categories( 'depth=1&title_li=' ); ?>
					</ul>
				<?php endif; ?>
			</div>
			<div id="footer-4" class="footer-column">
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_4' ) ) : ?>
					<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
	<div id="copyright" class="wrapper">
		<p>
			<?php
				printf(
					__( '<a href="%1$s">Linen Theme</a> by <a href="%2$s">The Theme Foundry</a>', 'linen' ),
					'http://thethemefoundry.com/linen/',
					'http://thethemefoundry.com/'
				);
			?>
		</p>
		<p>
			<?php printf(
				__( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'linen' ),
				date( 'Y' ),
				$linen->copyrightName()
			); ?>
		</p>
	</div><!--end copyright-->
<?php wp_footer(); ?>
</body>
</html>