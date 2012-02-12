<?php
/*
Template Name: Beer roll
*/
?>
<?php get_header(); ?>
    <h1 class="pagetitle"><?php _e('Beer roll', 'linen'); ?></h1>
    <div class="entry beer">
        <p>I do like a good beer so when someone I know, and occasionally someone I don't know undertakes the noble act of buying one for me I like to provide a little bit of thanks back; normally via buying THEM a beer and by chucking their name up on this list.</p>
    	<ul>
    		<?php
            $bookmarks = get_bookmarks( array(
            				'orderby'        => 'name',
            				'order'          => 'ASC',
            				'category_name'  => 'Beer roll'
                                      ));

            // Loop through each bookmark and print formatted output
            foreach ( $bookmarks as $bm ) { 
                printf( '<li><a class="relatedlink" href="%s">%s</a></li>', $bm->link_url, __($bm->link_name) );
            }
            ?>
    	</ul>
    	<p>The list doesn't feel that full right now (due to awful site lag on my part) so if you don't see your name please let me know - I'll put it up here ASAP! Equally you could use my list of upcoming events and buy me a beer at one of those...</p>
    </div><!--end-entry-->
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>