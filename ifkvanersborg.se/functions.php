<?php

// Add scripts
if( !is_admin()){
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false, '1.10.2', true);
	wp_enqueue_script('jquery');
	wp_register_script('modernizr', (get_template_directory_uri() . "/js/modernizr.js"), false, '1', false);
	wp_enqueue_script('modernizr');
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
set_post_thumbnail_size( 1000, 700 ); // Unlimited height, soft crop

//Menu Support
add_theme_support( 'menus' );


// Register menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
  register_nav_menus(
    array( 'header-menu' => __( 'Header Menu' ) )
  );
}


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
/*if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Nyhetssidan',
'before_widget' => '<div class="box">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));*/


/*// Adds custom classes to body if sidebar is not present, or if specified templates are used
add_filter( 'body_class', 'time_body_class' );
function time_body_class( $classes ) {
	if ( ! is_active_sidebar( 'Standard höger' ) || is_page_template( 'page-fullwidth.php' ) )
		$classes[] = 'fullwidth';

	return $classes;
}*/


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