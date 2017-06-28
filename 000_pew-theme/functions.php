<?php
/*
Author: Ana Gomiz
URL: http://pensandoenweb.es
*/

// Get Pew
require_once('library/pew.php'); // custom theme functions

// Admin Functions (commented out by default)
require_once('library/back.php'); // custom admin functions

// Custom Post Type Theme
require_once('library/custom-post-type.php'); // custom admin functions

/*********************
LAUNCH pew
Let's get everything up and running.
*********************/
function pew_ahoy() {

  // Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // launching operation cleanup
  add_action( 'init', 'pew_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'pew_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'pew_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'pew_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'pew_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'pew_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  pew_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'pew_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'pew_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'pew_excerpt_more' );

} /* end pew ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'pew_ahoy' );


/************* EMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
  $content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'noticia', 315, 315, true );
add_image_size( 'post', 390, 265, true );


add_filter( 'image_size_names_choose', 'pew_custom_image_sizes' );

function pew_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'pew-thumb-600' => __('600px por 150px'),
        'pew-thumb-300' => __('300px por 100px'),
    ) );
}
/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function pew_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Sidebar', 'pew' ),
    'description' => __( 'Arrastra aquí los elementos de tu sidebar.', 'pew' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  /*
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call
  your new sidebar just use the following code:

  Just change the name to whatever your new
  sidebar's id is, for example:

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Sidebar 2', 'pew' ),
    'description' => __( 'The second (secondary) sidebar.', 'pew' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php

  */
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function pew_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('listado-comentarios'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();

        ?>
        <?php // end custom gravatar call ?>
        <?php printf(__( '<div class="name-date"><div><h5 class="fn">%1$s</h5> %2$s', 'arqtecas' ), get_comment_author_link(), edit_comment_link(__( 'Editar', 'arqtecas' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('j-m-Y'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo comment_time('j-m-Y'); ?></a></time></div></div>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'arqtecas' ) ?></p>
        </div>
      <?php endif; ?>
      <footer class="comment-content">
        <?php comment_text() ?>
      </footer>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');

    // Uncomment below to remove from admin
    // add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

remove_action( 'wp_head', 'rest_output_link_wp_head');

// woocommerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// datos propios de la empresa
if ( file_exists( TEMPLATEPATH . '/class.my-theme-options.php' ) ) {
  require_once( TEMPLATEPATH . '/class.my-theme-options.php' );
}
/* DON'T DELETE THIS CLOSING TAG */ ?>