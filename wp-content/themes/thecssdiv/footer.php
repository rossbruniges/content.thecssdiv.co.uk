<?php global $linen; ?>
</div><!--end wrapper-->
	<?php if ( $linen->footerDisable() != 'true' ) { ?>
		<div id="footer" class="clear">
			<div class="footer-column">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_1') ) : ?>
					<h2 class="widgettitle"><?php _e( 'About Me' , 'linen' ); ?></h2>
					<p><?php _e( "Did you know you can write your own about section just like this one? It's really easy. Navigate to <code>Appearance &rarr; Widgets</code> and create a new Text Widget. Now move it to the Footer 1 sidebar." , "linen" ); ?></p>
					<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>
				<?php endif; ?>
			</div>
			<div id="footer-2" class="footer-column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_4' ) ) : ?>
				<div class="twitter-section">
                    <h2>Latest tweet</h2>
                	<p><?php aktt_latest_tweet(); ?></p>
                    <p>For more of the same and to be the first to hear what I am up to <a href="http://twitter.com/rossbruniges">follow me on twitter</a>.</p>
                			</div>
				<?php endif; ?>
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_3' ) ) : ?>
					<h2 class="widgettitle"><?php _e( 'Find me at...', 'linen' ); ?></h2>
					<script src="http://cdn.lanyrd.net/badges/person-v1.min.js"></script>
					<div class="lanyrd-target-splat"><a href="http://lanyrd.com/people/rossbruniges/" class="lanyrd-splat lanyrd-number-3 lanyrd-context-future" rel="me">My conferences on Lanyrd</a></div>
				<?php endif; ?>

			</div>
			<div id="footer-3" class="footer-column">
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footer_2' ) ) : ?>
					<h2 class="widgettitle"><?php _e( 'ross-eats.co.uk' , 'linen' ); ?></h2>
					<div class="flickr-footer">
                        <?php
                    	    $url = "http://www.flickr.com/badge_code_v2.gne?count=4&display=latest&size=s&layout=x&source=user_tag&user=92146798%40N00&tag=ross-eats";
                    				
                    	?>
                    	<?php
                    	    $html = file_get_contents($url);
                    		preg_match_all("/<div.*div>/", $html, $matches);
                    		foreach($matches[0] as $div) {
                    		    echo str_replace("></a>", "/></a>", $div);
                    		}
                    	?>
                    </div>
                    <p>My other passion is food, fine dining and eating out. When I'm not blogging about web development I'll likely be writing about food over at <a href="http://www.ross-eats.co.uk">ross-eats</a> and posting photos like those above to flickr.</p>
                <p>If you're in London and looking for a good place to eat check out <a href="http://www.ross-eats.co.uk">ross-eats</a> and follow <a href="http://www.twitter.com/ross_eats">@ross_eats on twitter</a>.</p>
				<?php endif; ?>

			</div>
			<div id="footer-4" class="footer-column">
				<script src="http://www.urbanspoon.com/b/posts/4207?title=ross-eats on urbanspoon"><noscript><a href="http://www.urbanspoon.com/br/52/4207/London/Ross-eats.html">Ross eats London restaurants</a></noscript></script>
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
