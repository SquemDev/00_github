<?php
/* 
Custom theme functions
*/
/* GOOGLE FONTS */
function pew_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}
add_action('wp_enqueue_scripts', 'pew_fonts');

// clean up the header tag
function pew_head_cleanup() {
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'pew_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'pew_remove_wp_ver_css_js', 9999 );

} /* end pew head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function pew_rss_version() { return ''; }

// remove WP version from scripts
function pew_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function pew_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function pew_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function pew_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/
// loading modernizr and jquery, and reply script
function pew_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {
		// modernizr (without media query polyfill)
		wp_register_script( 'pew-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'pew-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );


    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }

		//adding scripts file in the footer
		wp_register_script( 'pew-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'pew-modernizr' );
		wp_enqueue_style( 'pew-stylesheet' );
		
		// I recommend using a plugin to call jQuery
		// using the google cdn. That way it stays cached
		// and your site will load faster.
		// wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'pew-js' );
	}
}
#######################################
// Replace the default jQuery with the official Google jQuery library
#######################################
//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');

// remove emoticons
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*********************
THEME SUPPORT
*********************/
// Adding WP 3+ Functions & Theme Support
function pew_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Menú principal', 'pew' ),   // main nav in header
			'footer-links' => __( 'Links en pie de página', 'pew' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end pew theme support */


/*********************
RELATED POSTS FUNCTION
*********************/
// Related Posts Function (call using pew_related_posts(); )
function pew_related_posts() {
	echo '<ul id="pew-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'pew' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end pew related posts function */

/*********************
PAGE NAVI
*********************/
// Numeric Page Navi (built into the theme by default)
function pew_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => 'Página anterior',
    'next_text'    => 'Página siguiente',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/
// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function pew_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function pew_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'pew' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Leer más &raquo;', 'pew' ) .'</a>';
}
// ------------------------------------------
// limit words in excerpt
// ------------------------------------------
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).' ...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// Comentarios lo último ///
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

/**
* Eliminar jquery y jquery migrate de Wordpress
*/
function remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');        
    }
}
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

// páginas legales
add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/'); 
  $templatename = 'politica-privacidad'; 
  $pos = strpos($url_path, $templatename); 
    if ($pos !== false) {
     // load the file if exists
     $load = locate_template('pages/page-politica-privacidad.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});

add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/'); 
  $templatename = 'aviso-legal'; 
  $pos = strpos($url_path, $templatename); 
    if ($pos !== false) {
     // load the file if exists
     $load = locate_template('pages/page-aviso-legal.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});

add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/'); 
  $templatename = 'politica-cookies'; 
  $pos = strpos($url_path, $templatename); 
    if ($pos !== false) {
     // load the file if exists
     $load = locate_template('pages/page-politica-cookies.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});



/* 
 *	Este fragmento de codigo consigue establecer un tamaño máximo y mínimo de subida de archivos jpg :) 
 *
 *	DOC:  https://wordpress.stackexchange.com/questions/130203/limit-image-resolution-on-upload
 */
add_filter('wp_handle_upload_prefilter','mdu_validate_image_size');
function mdu_validate_image_size( $file ) {
    $image = getimagesize($file['tmp_name']);
    $minimum = array(
        'width' => '400',
        'height' => '400'
    );
    $maximum = array(
        'width' => '2000',
        'height' => '2000'
    );
    $image_width = $image[0];
    $image_height = $image[1];

    $too_small = "Las dimensiones de la imagen son demasiado pequeñas. El tamaño mínimo es de {$minimum['width']} por {$minimum['height']} pixels. Ha subido una imagen de $image_width por $image_height pixels.";
    $too_large = "Las dimensiones de la imagen son demasiado grandes. El tamaño máximo es de {$maximum['width']} por {$maximum['height']} pixels. La imagen que ha subido es de $image_width por $image_height pixels.";

    if ( $image_width < $minimum['width'] || $image_height < $minimum['height'] ) {
        // add in the field 'error' of the $file array the message 
        $file['error'] = $too_small; 
        return $file;
    }
    elseif ( $image_width > $maximum['width'] || $image_height > $maximum['height'] ) {
        //add in the field 'error' of the $file array the message
        $file['error'] = $too_large; 
        return $file;
    }
    else
        return $file;
}


?>