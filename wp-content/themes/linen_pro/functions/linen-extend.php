<?php

/*
----- Table of Contents

	1.  Load other functions
	2.  Set up theme specific variables
	3.  Image max width
	4.  Define image sizes
	5.  Add custom background
	6.  Add option to limit the content
	7.  Enqueue Client Files
	8.  Print Header Items
				I.    Slider
				II.   Accent Font
				III.  Body Font
	9.  Register Sidebars
	10. Main Menu Fallback
	11. Navigation Function
	12. Get sticky posts count
	13. Define theme options
	14. Theme option return functions
				I.    Logo Functions
				II.   Slider Functions
				III.  Subscribe Functions
				IV.   Font Functions
				V.    Layout Functions
				VI.   Footer Functions

*/

/*---------------------------------------------------------
	1. Load other functions
------------------------------------------------------------ */
locate_template( array( 'functions' . DIRECTORY_SEPARATOR . 'comments.php' ), true );
locate_template( array( 'functions' . DIRECTORY_SEPARATOR . 'ttf-admin.php' ), true );


if (!class_exists( 'Linen' )) {
	class Linen extends TTFCore {

		/*---------------------------------------------------------
			2. Set up theme specific variables
		------------------------------------------------------------ */
		function Linen () {

			$this->themename = "Linen";
			$this->themeurl = "http://thethemefoundry.com/linen/";
			$this->shortname = "linen";
			$this->domain = "linen";

			add_action( 'init', array(&$this, 'registerMenus' ));
			add_action( 'setup_theme_linen', array(&$this, 'setOptions' ) );

			add_action( 'wp_head', array( &$this, 'printHeaderItems' ) );
			add_action( 'wp_enqueue_scripts', array( &$this, 'enqueueClientFiles' ) );

			$this->addCustomBackground();

			parent::TTFCore();
		}

		/*---------------------------------------------------------
			3. Image max width
		------------------------------------------------------------ */
		function addContentWidth() {
			global $content_width;
			if ( ! isset( $content_width ) ) {
				$content_width = 620;
			}
		}

		/*---------------------------------------------------------
			4. Define image sizes
		------------------------------------------------------------ */
		function addImageSize() {
			add_image_size( 'featured', 652, 300, true );
			add_image_size( 'index-thumb', 94, 94, true );
			add_image_size( 'single', 620, 9999 );
		}

		/*---------------------------------------------------------
			5. Add custom background
		------------------------------------------------------------ */
		function addCustomBackground() {
			add_custom_background();
		}

		/*---------------------------------------------------------
			6. Add option to limit the content
		------------------------------------------------------------ */
		function customContent($limit) {

			$link = get_permalink();
			$content = explode( ' ', strip_tags(get_the_content()), $limit );
			array_pop( $content );
			$content = implode(" ", $content) . '...' . '<a class="more-link" href="'. $link .'">' . __( 'Read more' ) . '</a>';
			$content = preg_replace('/<img[^>]+./','', $content);
			$content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s','', $content );
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
			return $content;

		}

		/*---------------------------------------------------------
			7. Enqueue Client Files
		------------------------------------------------------------ */
		function enqueueClientFiles() {
			global $wp_styles;

			if ( ! is_admin() ) {
				wp_enqueue_style(
					'linen-style',
					get_bloginfo( 'stylesheet_url' ),
					'',
					null
				);

				wp_enqueue_style(
					'linen-ie-style',
					get_template_directory_uri() . '/stylesheets/ie.css',
					array( 'linen-style' ),
					null
				);
				$wp_styles->add_data( 'linen-ie-style', 'conditional', 'lt IE 8' );

				if ( ( 'disable' != $this->accentFont() ) ) {
					wp_enqueue_style(
						'linen-accent-font-style',
						'http://fonts.googleapis.com/css?family=' . $this->accentFont(),
						array( 'linen-style' ),
						null
					);
				}

				if ( ( 'disable' != $this->bodyFont() ) && ( $this->bodyFont() != $this->accentFont() ) ) {
					wp_enqueue_style(
						'linen-body-font-style',
						'http://fonts.googleapis.com/css?family=' . $this->bodyFont(),
						array( 'linen-style' ),
						null
					);
				}

				if ( is_singular() ) {
					wp_enqueue_script( 'comment-reply' );
				}

				wp_enqueue_script( 'jquery' );

				wp_enqueue_script(
					'linen',
					get_template_directory_uri() . '/javascripts/linen.js',
					array( 'jquery' ),
					null
				);
			}
		}

		/*---------------------------------------------------------
			8. Print Header Items
		------------------------------------------------------------ */
		function printHeaderItems() {

			/*---------------------------------------------------------
				I. Slider
			------------------------------------------------------------ */
			if ( is_front_page() && ($this->sliderState() != '' ) ) : ?>
				<?php
					$play = 0;
					$slidespeed = 350;
					$fadespeed = 350;
					if ($this->sliderSpeed() != '' )
						$slidespeed = $this->sliderSpeed();
					if ($this->sliderStart() == 'true' )
						$play = $this->sliderDelay();
					else
						$play = 0;
				?>
				<script>
					jQuery(function(){
						jQuery("#featured").slides({
							generatePagination: false,
							play: <?php echo esc_js( $play ); ?>,
							slideSpeed: <?php echo esc_js( $slidespeed ); ?>
						});
					});
				</script>
				<?php
			endif;

			/*---------------------------------------------------------
				II. Accent Font
			------------------------------------------------------------ */
			if ( $this->accentFont() == 'Cabin:bold' )
				$accent_font = 'Cabin';
			elseif ( $this->accentFont() == 'Droid+Sans' )
				$accent_font = 'Droid Sans';
			elseif ( $this->accentFont() == 'Droid+Serif' )
				$accent_font = 'Droid Serif';
			else
				$accent_font = $this->accentFont();

			if ( 'disable' != $this->accentFont() ) : ?>
				<style type="text/css">#title, .nav a, .slide-content h3, .slide-content a.more-link, .entry h2.title, .single-post-title, .post-date, .entry a.more-link, div.post-comments a, .entry h2, .entry h3, .entry h4, .post-footer, .navigation, h1.pagetitle, h2.pagetitle, .entries li span, #sidebar h2.widgettitle, .comment-number, div.c-head, div.reply, div.cancel-comment-reply, h3#reply-title, .footer-column h2, #copyright { font-family: '<?php echo $accent_font ?>', Helvetica, Arial, sans-serif; }</style>
				<?php
			endif;

			/*---------------------------------------------------------
				III. Body Font
			------------------------------------------------------------ */
			if ( $this->bodyFont() == 'Droid+Sans' )
				$body_font = 'Droid Sans';
			elseif ( $this->bodyFont() == 'Droid+Serif' )
				$body_font = 'Droid Serif';
			elseif ( $this->bodyFont() == 'Cantarell:regular,italic' )
				$body_font = 'Cantarell';
			elseif ( $this->bodyFont() == 'Nobile:regular,italic' )
				$body_font = 'Nobile';
			elseif ( $this->bodyFont() == 'Puritan:regular,italic' )
				$body_font = 'Puritan';
			else
				$body_font = $this->bodyFont();

			if ( 'disable' != $this->bodyFont() ) : ?>
				<style type="text/css">body { font-family: '<?php echo $body_font ?>', Georgia, Times, serif; }</style>
				<?php
			endif;

		}

		/*---------------------------------------------------------
			9. Register Sidebars
		------------------------------------------------------------ */
		function registerSidebars() {

			register_sidebar( array(
				'name'=> __( 'Sidebar', 'linen' ),
				'id' => 'sidebar_1',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			) );
			register_sidebar( array(
				'name'=> __( 'Footer 1', 'linen' ),
				'id' => 'footer_1',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			) );
			register_sidebar( array(
				'name'=> __( 'Footer 2', 'linen' ),
				'id' => 'footer_2',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			) );
			register_sidebar( array(
				'name'=> __( 'Footer 3', 'linen' ),
				'id' => 'footer_3',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			) );
			register_sidebar( array(
				'name'=> __( 'Footer 4', 'linen' ),
				'id' => 'footer_4',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			) );

		}

		/*---------------------------------------------------------
			10. Main Menu Fallback
		------------------------------------------------------------ */
		function main_menu_fallback() {
			?>
			<div id="navigation" class="clear">
				<ul class="nav">
					<?php
						wp_list_pages( 'title_li=' );
					?>
				</ul>
			</div>
			<?php
			}

		/*---------------------------------------------------------
			11. Navigation Functions
		------------------------------------------------------------ */
		function registerMenus() {
			register_nav_menu( 'nav-1', __( 'Top Navigation' ) );
		}

		/*---------------------------------------------------------
			12. Get sticky posts count
		------------------------------------------------------------ */
		function get_sticky_posts_count() {
			global $wpdb;
			$sticky_posts = array_map( 'absint', (array) get_option('sticky_posts') );
			return count($sticky_posts) > 0 ? $wpdb->get_var( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (".implode(',', $sticky_posts).")" ) : 0;
		}

		/*---------------------------------------------------------
			13. Define theme options
		------------------------------------------------------------ */
		function setOptions() {

			/*
				OPTION TYPES:
				- checkbox: name, id, desc, std, type
				- radio: name, id, desc, std, type, options
				- text: name, id, desc, std, type
				- colorpicker: name, id, desc, std, type
				- select: name, id, desc, std, type, options
				- textarea: name, id, desc, std, type, options
			*/

			$this->options = array(

				array(
					"name" => __( 'Custom Logo Image <span>insert your custom logo image in the header</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Enable custom logo image', 'linen' ),
					"id" => $this->shortname."_logo",
					"desc" => __( 'Check to use a custom logo in the header.', 'linen' ),
					"std" => "false",
					"type" => "checkbox"),

				array(
					"name" => __( 'Logo URL.', 'linen' ),
					"id" => $this->shortname."_logo_img",
					"desc" => sprintf( __( 'Upload an image or enter an URL for your image.', 'linen' ), '<code>' . STYLESHEETPATH . '/images/</code>' ),
					"std" => '',
					"upload" => true,
					"class" => "logo-image-input",
					"type" => "upload"),

				array(
					"name" => __( 'Logo image <code>&lt;alt&gt;</code> tag', 'linen' ),
					"id" => $this->shortname."_logo_img_alt",
					"desc" => __( 'Specify the <code>&lt;alt&gt;</code> tag for your logo image.', 'linen' ),
					"std" => '',
					"type" => "text"),

				array(
					"name" => __( 'Display tagline', 'linen' ),
					"id" => $this->shortname."_tagline",
					"desc" => __( 'Check to show your tagline below your logo.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Featured Slider <span>take control of your featured slider.</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Enable featured slider', 'linen' ),
					"id" => $this->shortname."_slider",
					"desc" => __( 'Check to turn on your featured slider. The featured slider requires a minimum of 2 sticky posts.', 'linen' ),
					"std" => "false",
					"type" => "checkbox"),

				array(
					"name" => __( 'Autostart', 'linen' ),
					"id" => $this->shortname."_slider_start",
					"desc" => __( 'Check to start your featured slider automatically.', 'linen' ),
					"std" => "false",
					"type" => "checkbox"),

				array(
					"name" => __( 'Autostart delay', 'linen' ),
					"id" => $this->shortname."_slider_delay",
					"desc" => __( 'Delay before the autostart and the delay between slides in milliseconds (1000 = 1 second).', 'linen' ),
					"std" => "4000",
					"type" => "text"),

				array(
					"name" => __( 'Slide animation speed', 'linen' ),
					"id" => $this->shortname."_slider_speed",
					"desc" => __( 'Speed of the sliding animation in milliseconds (1000 = 1 second).', 'linen' ),
					"std" => "350",
					"type" => "text"),

				array(
					"name" => __( 'Subscribe Links <span>control the subscribe links</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Enable Twitter', 'linen' ),
					"id" => $this->shortname."_twitter_toggle",
					"desc" => __( 'Hip to Twitter? Check this box. Please set your Twitter username in the Twitter menu.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Enable Facebook', 'linen' ),
					"id" => $this->shortname."_facebook_toggle",
					"desc" => __( 'Check this box to show a link to your Facebook page.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Enable Flickr', 'linen' ),
					"id" => $this->shortname."_flickr_toggle",
					"desc" => __( 'Check this box to show a link to Flickr.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Disable all', 'linen' ),
					"id" => $this->shortname."_follow_disable",
					"desc" => __( 'Check this box to hide all follow icons (including RSS). This option overrides any other settings.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Twitter name', 'linen' ),
					"id" => $this->shortname."_twitter",
					"desc" => __( 'Enter your Twitter name.', 'linen' ),
					"std" => '',
					"type" => "text"),

				array(
					"name" => __( 'Facebook link', 'linen' ),
					"id" => $this->shortname."_facebook",
					"desc" => __( 'Enter your Facebook link.', 'linen' ),
					"std" => '',
					"type" => "text"),

				array(
					"name" => __( 'Flickr link', 'linen' ),
					"id" => $this->shortname."_flickr",
					"desc" => __( 'Enter your Flickr link.', 'linen' ),
					"std" => '',
					"type" => "text"),

				array(
					"name" => __( 'Typography <span>customize your fonts</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Accent font', 'linen' ),
					"desc" => __( 'Used for accents and headers. Fallback font stack is "Helvetica, Arial, sans-serif". Added page weight is in parentheses.' ),
					"id" => $this->shortname."_accent_font",
					"std" => '',
					"type" => "select",
					"options" => array(
						"Arvo" => __( 'Arvo (27kb)', 'linen' ),
						"Cabin:bold" => __( 'Cabin (39kb)', 'linen' ),
						"Copse" => __( 'Copse (22kb)', 'linen' ),
						"Droid+Sans" => __( 'Droid Sans (26kb)', 'linen' ),
						"Droid+Serif" => __( 'Droid Serif (28kb)', 'linen' ),
						"disable" => __( 'Helvetica', 'linen' ),
						"Lato" => __( 'Lato (49kb)', 'linen' ) ) ),

				array(
					"name" => __( 'Body font', 'linen' ),
					"desc" => __( 'Used for the body text. Fallback font stack is "Georgia, Times, serif". Added page weight is in parentheses.' ),
					"id" => $this->shortname."_body_font",
					"std" => 'disable',
					"type" => "select",
					"options" => array(
						"Cantarell:regular,italic" => __( 'Cantarell (53kb)', 'linen' ),
						"Droid+Sans" => __( 'Droid Sans (26kb)', 'linen' ),
						"Droid+Serif" => __( 'Droid Serif (28kb)', 'linen' ),
						"disable" => __( 'Georgia', 'linen' ),
						"Lato" => __( 'Lato (49kb)', 'linen' ),
						"Neuton" => __( 'Neuton (18kb)', 'linen' ),
						"Nobile:regular,italic" => __( 'Nobile (57kb)', 'linen' ),
						"Puritan:regular,italic" => __( 'Puritan (60kb)', 'linen' ) ) ),

				array(
					"name" => __( 'Layout <span>change the default layout</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Disable Sidebar', 'linen' ),
					"id" => $this->shortname."_sidebar_disable",
					"desc" => __( 'Check this box to disable the sidebar. This removes the sidebar from <strong>all</strong> pages and posts.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Disable Footer', 'linen' ),
					"id" => $this->shortname."_footer_disable",
					"desc" => __( 'Check this box to disable the footer widget area. This removes the footer from <strong>all</strong> pages and posts.', 'linen' ),
					"std" => '',
					"type" => "checkbox"),

				array(
					"name" => __( 'Footer <span>add a copyright notice and tracking codes</span>', 'linen' ),
					"type" => "subhead"),

				array(
					"name" => __( 'Copyright notice', 'linen' ),
					"id" => $this->shortname."_copyright_name",
					"desc" => __( 'Your name or the name of your business.', 'linen' ),
					"std" => '',
					"type" => "text"),

				array(
					"name" => __( 'Stats code', 'linen' ),
					"id" => $this->shortname."_stats_code",
					"desc" => sprintf( __( 'If you would like to use Google Analytics or any other tracking script in your footer just paste it here. The script will be inserted before the closing %s tag.', 'linen' ), '<code>&#60;/body&#62;</code>' ),
					"std" => '',
					"type" => "textarea",
					"options" => array(
						"rows" => "5",
						"cols" => "40") ),
			);
		}

		/*---------------------------------------------------------
			14. Theme option return functions
		------------------------------------------------------------ */

			/*---------------------------------------------------------
				I. Logo Functions
			------------------------------------------------------------ */
			function logoState () {
				return get_option($this->shortname.'_logo' );
			}
			function logoName () {
				return get_option( $this->shortname.'_logo_img' );
			}
			function logoAlt () {
				return get_option($this->shortname.'_logo_img_alt' );
			}
			function logoTagline () {
				return get_option($this->shortname.'_tagline' );
				}

			/*---------------------------------------------------------
				II. Slider Functions
			------------------------------------------------------------ */
			function sliderState () {
				return get_option($this->shortname.'_slider' );
			}
			function sliderStart () {
				return get_option($this->shortname.'_slider_start' );
			}
			function sliderDelay () {
				return get_option($this->shortname.'_slider_delay' );
			}
			function sliderSpeed () {
				return get_option($this->shortname.'_slider_speed' );
			}

			/*---------------------------------------------------------
				III. Subscribe Functions
			------------------------------------------------------------ */
			function twitter() {
				return stripslashes( wp_filter_post_kses(get_option($this->shortname.'_twitter' )) );
			}
			function twitterToggle() {
				return get_option($this->shortname.'_twitter_toggle' );
			}
			function facebook() {
				return stripslashes( wp_filter_post_kses(get_option($this->shortname.'_facebook' )) );
			}
			function facebookToggle() {
				return get_option($this->shortname.'_facebook_toggle' );
			}
			function flickr() {
				return wp_filter_post_kses(get_option($this->shortname.'_flickr' ));
			}
			function flickrToggle() {
				return get_option($this->shortname.'_flickr_toggle' );
			}
			function followDisable() {
				return get_option($this->shortname.'_follow_disable' );
			}

			/*---------------------------------------------------------
				IV. Font Functions
			------------------------------------------------------------ */
			function accentFont () {
				return get_option($this->shortname.'_accent_font', 'Arvo' );
			}
			function bodyFont () {
				return get_option($this->shortname.'_body_font', 'disable' );
			}

			/*---------------------------------------------------------
				V. Layout
			------------------------------------------------------------ */
			function sidebarDisable() {
				return get_option($this->shortname.'_sidebar_disable' );
			}
			function footerDisable() {
				return get_option($this->shortname.'_footer_disable' );
			}

			/*---------------------------------------------------------
				VI. Footer Functions
			------------------------------------------------------------ */
			function copyrightName() {
				return stripslashes( wp_filter_post_kses(get_option($this->shortname.'_copyright_name' )) );
			}

	}
}

/* SETTING EVERYTHING IN MOTION */
function load_linen_pro_theme() {
	$GLOBALS['linen'] = new Linen;
}

add_action( 'after_setup_theme', 'load_linen_pro_theme' );