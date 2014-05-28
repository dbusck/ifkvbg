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
	'before_widget' => '<div class="medium-3 column"><ul class="no-bullet">',
	'after_widget' => '</ul></div>',
	'before_title' => '<h4 class="caps">',
	'after_title' => '</h4>',
) );




/*// Adds custom classes to body if sidebar is not present, or if specified templates are used
add_filter( 'body_class', 'time_body_class' );
function time_body_class( $classes ) {
	if ( ! is_active_sidebar( 'Standard höger' ) || is_page_template( 'page-fullwidth.php' ) )
		$classes[] = 'fullwidth';

	return $classes;
}*/










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