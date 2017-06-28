<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<section class="mod-slider total relative">
    <div class="slider-home">
        <?php
          $temp = $wp_query; 
          $wp_query = null; 
          $wp_query = new WP_Query(); 
          $wp_query->query('showposts=-1&post_type=slider_home&orderby=rand'.'&paged='.$paged); 
          $count_posts = wp_count_posts('slider_home'); 
        ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
        <?php $custom_fields = get_post_custom(); ?>
        <article class="item">
            <?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail('slider'); ?>
            <?php } ?>
			<div class="text">
				<h2 class="title">
          <?php if( isset($custom_fields['text1_slider']) ) { 
              echo "<em class='total'>"
                  .$custom_fields['text1_slider'][0];
              echo "</em>";
          }?>

          <?php if( isset($custom_fields['text2_slider']) ) { 
              echo "<strong class='total'>"
                  .$custom_fields['text2_slider'][0];
              echo "</strong>";
          }?>
        </h2>
        <?php if( isset($custom_fields['textboton_slider']) ) { ?>
          <a href="<?php echo $custom_fields['link_slider'][0]; ?>" class="btn btn-transparent">
           <?php echo $custom_fields['textboton_slider'][0]; ?>
          </a>
        <?php }?>
			</div>
        </article>
        <?php endwhile; ?>
    </div>
  
  <section class="mod-reserva-rest">
    <span class="tl"></span>
    <span class="tr"></span>
    
    <div class="total">
      <h5 class="title"><span><?php _e('Reserva tu mesa en','hmp-theme'); ?></span><strong><?php _e('Nuestro restaurante','hmp-theme'); ?></strong></h5>
      <?php echo do_shortcode('[contact-form-7 id="83" title="reserva"]'); ?>       
    </div>
    <span class="bl"></span>
    <span class="br"></span>
  </section>
</section>
