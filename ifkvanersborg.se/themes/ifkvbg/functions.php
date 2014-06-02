<?php

// Add scripts
if( !is_admin()){
	wp_register_script('modernizr', (get_template_directory_uri() . "/js/vendor/modernizr.js"), false, '1', false);
	wp_enqueue_script('modernizr');
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false, '1.10.2', true);
	wp_enqueue_script('jquery');
	wp_register_script('foundation', (get_template_directory_uri() . "/js/min/foundation.min.js"), false, '1', true);
	wp_enqueue_script('foundation');
	wp_register_script('foundation_dropdown', (get_template_directory_uri() . "/js/foundation/foundation.dropdown.js"), false, '1', true);
	wp_enqueue_script('foundation_dropdown');
	wp_register_script('application', (get_template_directory_uri() . "/js/min/application.min.js"), false, '1', true);
	wp_enqueue_script('application');
}







// Google Analytics in footer
/*add_action('wp_head', 'add_google_analytics_tracking');
function add_google_analytics_tracking() { ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '***** ANALYTICS-ID *******']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php }*/





/*// Update options with custom options from custom settings page
add_action( 'after_setup_theme', 'update_site_custom_options' );
function update_site_custom_options() {
	$getoption = get_option('site-settings');
	update_option( 'blogdescription', $getoption['site-description'] );
}*/






// Custom excerpt length
add_filter('excerpt_length', 'custom_excerpt_length');
function custom_excerpt_length($length) {
	return 30;
}






// Replace default excerp [...] with read-more link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Läs mer</a>';
}







// Remove inline-style in tagcloud
add_filter('wp_generate_tag_cloud', 'xf_tag_cloud',10,3);
function xf_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}


// Remove inline styling for gallery
add_filter( 'use_default_gallery_style', '__return_false' );







//Featured Image Support
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 1100, 500 ); // Unlimited height, hard crop


//Menu Support
add_theme_support( 'menus' );


// Register menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
  register_nav_menus(
    array( 'header-menu' => __( 'Header Menu' ) )
  );
}


// This theme styles the visual editor to resemble the theme style.
add_editor_style( 'css/editor-style.css' );


add_theme_support( 'html5', array( 'search-form' ) );








// List topmost ancestor and its immediate children
if(!function_exists('get_post_top_ancestor_id')){
function get_post_top_ancestor_id(){
    global $post;
    
    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}}







//Widget areas

register_sidebar( array(
	'name'         => __( 'Sidopanel' ),
	'id'           => 'default',
	'description'  => __( 'Standard sidopanel som syns på de flesta undersidor.' ),
	'before_widget' => '<div class="panel widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="caps">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name'         => __( 'Sidfot' ),
	'id'           => 'footer',
	'description'  => __( 'Widgets som syns i sidfoten. Från början tre stycken, tänkta att vara kontaktinformation.' ),
	'before_widget' => '<div class="medium-3 column"><ul class="no-bullet">',
	'after_widget' => '</ul></div>',
	'before_title' => '<h4 class="caps">',
	'after_title' => '</h4>',
) );

register_sidebar( array(
	'name'         => __( 'Nyheter' ),
	'id'           => 'news',
	'description'  => __( 'Sidopanel för nyhetssidor' ),
	'before_widget' => '<div class="panel widget">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="caps">',
	'after_title' => '</h3>',
) );






// Admin customization for client

// Disable the web file editor
define('DISALLOW_FILE_EDIT', true);

// Remove menu items from admin sidebar
add_action( 'admin_menu', 'remove_unused_menu_pages' );
function remove_unused_menu_pages() {
	        
	// Keep settings and SEO if admin (checks if user can delete plugins, last cap I would add to a client)
	if (!current_user_can('delete_plugins')) {
		remove_menu_page( 'wpseo_dashboard' );
	}
	
    //top level menus
    //remove_menu_page('edit-comments.php');
    remove_menu_page('link-manager.php');
    //remove_menu_page('edit.php');

    //submenus
    remove_submenu_page( 'themes.php', 'themes.php' );
    remove_submenu_page( 'tools.php', 'tools.php' );
}

// Remove menu items in admin bar
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-link');
	//$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('customize');
	//$wp_admin_bar->remove_menu('menus');
	$wp_admin_bar->remove_menu('updates');
}


// Remove admin metaboxes
add_action( 'admin_menu', 'remove_unused_dashboard_widgets' );
function remove_unused_dashboard_widgets() {
	// Remove each dashboard widget metabox for Incoming Links, Plugins, the WordPress Blog and Other WordPress News
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	//remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('postcustom', 'page', 'normal');
	remove_meta_box('postcustom', 'post', 'normal');
	remove_meta_box('wpseo_meta', 'post', 'normal');
}


// Add custom caps
// Only needs to be run once, comment out after
add_action( 'admin_init', 'add_client_user_caps');
function add_client_user_caps() {
    // gets the author role
    $role = get_role( 'editor' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'update_core' );
    $role->add_cap( 'import' ); 
    $role->add_cap( 'export' ); 
    $role->add_cap( 'edit_theme_options' ); 
    $role->add_cap( 'update_plugins' );
    $role->remove_cap( 'manage_options' );
}









// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);







//change the menu items label
! defined( 'ABSPATH' ) and exit; // Not a WordPress context? Stop.
add_action( 'init', array ( 'chg_post_menu_labels', 'init' ) );
add_action( 'admin_menu', array ( 'chg_post_menu_labels', 'admin_menu' ) );
class chg_post_menu_labels
{
    public static function init()
    {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = __('Nyheter');
        $labels->singular_name = __('Nyhet');
        $labels->add_new = __('Lägg till nyhet');
        $labels->add_new_item = __('Lägg till nyhet');
        $labels->edit_item = __('Redigera nyhet');
        $labels->new_item = __('Lägg till nyhet');
        $labels->view_item = __('Visa nyheter');
        $labels->search_items = __('Sök nyheter');
        $labels->not_found = __('Kunde inte hitta några nyheter');
        $labels->not_found_in_trash = __('Hittade inga nyheter i papperskorgen');
        $labels->name_admin_bar = __('Nyhet');
    }

    public static function admin_menu()
    {
        global $menu;
        global $submenu;
        $menu[5][0] = __('Nyheter');
        $submenu['edit.php'][5][0] = __('Nyheter');
        $submenu['edit.php'][10][0] = __('Lägg till nyhet');
    }
}
    

// Change dashboard footer text
add_filter('admin_footer_text', 'change_footer_admin');
function change_footer_admin() {
	echo 'Sidan gjord av Andrea Eriksson, Douglas Busck, Matilda Salekärr, Julia Thielen & Linnea Morberg – DIG13 Högskolan Väst.';
}






//Login page styling
add_action( 'login_enqueue_scripts', 'IFKVBG_login_styling' );
function IFKVBG_login_styling() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/ifk_vbglogo_simpel.png);
            padding-bottom: 20px;
            height:105px;
            width:120px;
            margin:0 auto;
            background-size:100px;
        }
        body.login {
        	background: #005191;
        }
        body.login #nav a, body.login #backtoblog a {
        	color:white !important;
        	text-shadow:none; 
        }
        body.login #nav a:hover, body.login #backtoblog a:hover { 
        	color:black; 
        }
        body.login form input.input {
        	color:white;
        	background:#005191;
        	border-radius:0;
        	border:0;
        }
    </style>
<?php }

// Login logo url
add_filter( 'login_headerurl', 'client_login_logo_url' );
function client_login_logo_url() {
    return get_bloginfo( 'url' );
}

// Login logo url title
add_filter( 'login_headertitle', 'client_login_logo_url_title' );
function client_login_logo_url_title() {
    return 'IFK Vänersborg';
}


















add_action( 'widgets_init', 'Custom_Markup_WP_Widget_Recent_Posts' );
function Custom_Markup_WP_Widget_Recent_Posts() {
    register_widget( 'Custom_Markup_WP_Widget_Recent_Posts' );
}

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Custom_Markup_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<ul class="no-bullet">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li class="row news-entry">
						<?php if ( $show_date ) : ?>
							<span class="post-date date caps medium-3 column"><?php echo get_the_date(); ?></span>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="post-title medium-9 column"><?php get_the_title() ? the_title() : the_ID(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

}













//Add to TinyMCE first row
add_filter( 'mce_buttons', 'custom_mce_buttons' );
function custom_mce_buttons( $buttons ) {
    array_splice( $buttons, 6, 0, 'hr');
    return $buttons;
}

//Add to TinyMCE second row
add_filter( 'mce_buttons_2', 'custom_mce_buttons_2' );
function custom_mce_buttons_2( $buttons ) {     
    
    //Add styleselect dropdown (unshift to add it first in row)
    array_unshift( $buttons, 'styleselect' );            
    return $buttons;
}













/*add_filter( 'tiny_mce_before_init', 'custom_mce_before_init' );
function custom_mce_before_init( $settings ) {

    //Add styles to styleselect dropdown
    $style_formats = array(
    	
    	//Buttons
    	array(
    	'title' => 'Knappar',
    	),
    	array(
    	'title' => 'Knapp, blå',
    	'selector' => 'a',
    	'classes' => 'btn'
    	),
    	array(
    	'title' => 'Knapp, svart',
    	'selector' => 'a',
    	'classes' => 'btn secondary'
    	),     
    );
    
   //Settings
    $settings['theme_advanced_blockformats'] = 'p,address,pre,h2,h3,h4,h5,h6';
    $settings['theme_advanced_disable'] = 'underline,strikethrough,forecolor,spellchecker,wp_help';
    
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}*/


/*//Custom stylesheet for editing (looks in theme dir)
add_editor_style('custom-editor-style.css');*/














//HTML compression
class WP_HTML_Compression
{
	// Settings
	protected $compress_css = false;
	protected $compress_js = false;
	protected $info_comment = true;
	protected $remove_comments = true;

	// Variables
	protected $html;
	public function __construct($html)
	{
		if (!empty($html))
		{
			$this->parseHTML($html);
		}
	}
	public function __toString()
	{
		return $this->html;
	}
	protected function bottomComment($raw, $compressed)
	{
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		
		$savings = ($raw-$compressed) / $raw * 100;
		
		$savings = round($savings, 2);
		
		return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
	}
	protected function minifyHTML($html)
	{
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		// Variable reused for output
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
			$content = $token[0];
			
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					
					// Don't print the comment
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						// Remove any HTML comments, except MSIE conditional comments
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						
						// Remove any empty attributes, except:
						// action, alt, content, src
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
						// Remove any space before the end of self-closing XHTML tags
						// JavaScript excluded
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			
			$html .= $content;
		}
		
		return $html;
	}
		
	public function parseHTML($html)
	{
		$this->html = $this->minifyHTML($html);
		
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
	}
	
	protected function removeWhiteSpace($str)
	{
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		
		return $str;
	}
}

function wp_html_compression_finish($html)
{
	return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
	ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');