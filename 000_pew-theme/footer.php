    <?php include (TEMPLATEPATH . '/templates-parts/google-maps.php'); ?>
    
    <!-- slick -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/slick.min.js"></script>
    </script>

	<script type="text/javascript">  
    // menu responsive
    $( ".btn-nav" ).click(function() {
      $( "#cssmenu" ).slideToggle( "slow", function() {
        // Animation complete.
      });
    });       

    // slick slider
    $('.slider-home').slick({
      slidesToShow: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      fade: true,
      autoplaySpeed: 4000,
    });
  </script>
    <?php wp_footer(); ?>
  </body>
</html>