<?php global $linen; ?>
<?php if ($linen->sidebarDisable() != 'true' ) { ?>
	<div id="sidebar">
		<?php if ($linen->followDisable() != 'true' ) { ?>
			<?php get_template_part( 'tmpart-subscribe' ); ?>
		<?php } ?>
		<ul>
		    <?php if(is_home() == "true") : ?>
		        <li class="widget">
		        <?php wp_list_bookmarks(array(
		            'orderby' => 'rand',
		            'limit' => 10,
		            'category_name' => 'Beer roll',
		            'title_li' => '',
		            'title_before' => '<h2 class="widgettitle">',
		            'category_before' => '',
		            'category_after' => ''
		        ));?>
		        <p>Over the years many people have bought me beer. To get your name on the list you know what to do!</p>
		        <p>Check the full <a href="/beer_roll">beer roll</a> to read the full alumni.</p>
		        </li>
		    <?php endif; ?>
		    <li class="widget">
		        <h2 class="widgettitle">Categories</h2>
		        <ul>
				<?php wp_list_cats(   'sort_column=name&hierarchical=0&exclude=64');
?>
				</ul>
		    </li>
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