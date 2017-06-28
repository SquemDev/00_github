<ul class="rrss">
  <?php if (mytheme_option( 'rrss_fb' )): ?>
      <li><a href="<?php echo mytheme_option( 'rrss_fb' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rs-fb.png" alt="<?php _e('Únete a nuestro Facebook','hmp-theme'); ?>"></a></li>            
  <?php endif ?>

  <?php if (mytheme_option( 'rrss_tw' )): ?>
    <li><a href="<?php echo mytheme_option( 'rrss_tw' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rs-tw.png" alt="<?php _e('Únete a nuestro Twitter','hmp-theme'); ?>"></a></li>
  <?php endif ?>

  <?php if (mytheme_option( 'rrss_gg' )): ?>
    <li><a href="<?php echo mytheme_option( 'rrss_gg' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rs-gg.png" alt="<?php _e('Únete a nuestro Google +','hmp-theme'); ?>"></a></li>
  <?php endif ?>

  <?php if (mytheme_option( 'rrss_in' )): ?>
    <li><a href="<?php echo mytheme_option( 'rrss_in' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rs-in.png" alt="<?php _e('Únete a nuestro Instagram +','hmp-theme'); ?>"></a></li>
  <?php endif ?>

  <?php if (mytheme_option( 'rrss_yt' )): ?>
    <li><a href="<?php echo mytheme_option( 'rrss_yt' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/rs-yt.png" alt="<?php _e('Únete a nuestro Youtube +','hmp-theme'); ?>"></a></li>
  <?php endif ?>
</ul>