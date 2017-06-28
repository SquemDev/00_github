<!-- mapa -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzALZ9EHaHBzzkz4tVhZrNAe9ZD6hKmN0"></script>
    <script type="text/javascript">
    function initialize() {
      var marcadores = [          
 
        
        [
          //LAT = 0
          <?php echo mytheme_option( 'latitud_granada' ); ?>,  
 
          //LNG = 1
          <?php echo mytheme_option( 'longitud_granada' ); ?>, 
 
          //NOMBRE ESTUDIO = 2
          '<img src="<?php echo get_template_directory_uri(); ?>/library/images/el-trillo-maps.png" alt="Restaurante El Trillo">', 
           
          // DIRECCION 1 malaga = 3
          '<?php echo mytheme_option( 'direccion1_granada' ); ?><br><?php echo mytheme_option( 'direccion2_granada' ); ?>',
 
          // TELEFONO malaga = 4
          '<?php echo mytheme_option( 'maps_granada' ); ?>',
 
          // MOVIL malaga = 5
          '<?php echo mytheme_option( 'tlf_movil_granada' ); ?>',
 
          // EMAIL malaga = 6
          '<?php echo mytheme_option( 'email_granada' ); ?>',
 
        ],
 
      ];
      var map = new google.maps.Map(document.getElementById('map'), {
        // Zoom que se le aplica al mapa
        zoom: 14,
        scrollwheel:  false,
        // Coordenadas LatLng de google 
        center: new google.maps.LatLng(<?php echo mytheme_option( 'latitud_granada' ); ?>,<?php echo mytheme_option( 'longitud_granada' ); ?>), // Andalucía
        //Tipo de mapa
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        // Estilos y colores del mapa 
        styles: [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-77}]},{"featureType":"road"}]
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
         
      /* Mapa con menos zoom en mobile */
      var width_page = $(document).width();  
      if( width_page > 767 ) {
        map.setZoom(14);
      }
      else {
        map.setZoom(7);
      }
      /* Fin zoom Mobile */
 
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][0], marcadores[i][1]),
          map: map,
          title: marcadores[i][2],
          //icono de marcador 
          // En caso de querer introducir un marcador propio unico introducir la url entre las ''
          icon: '<?php echo get_template_directory_uri(); ?>/library/images/marcador.png',
          //Función que llama a la animación de los marcadores 
          // Sin este código no se animan los marcadores
          animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          //bucle que recoje toda la información de la lista marcadores y la introduce en codigo html y css
          if(i == 0) {
            return function() {
              var tel_fijo = marcadores[0][5].replace(/\s+/g, '');
              var tel_movil = marcadores[0][6].replace(/\s+/g, '');
              infowindow.setContent(// Estilo de la caja de texto 
                  "<div style='width:250px;min-height:40px'><h2 style='margin-top: 15px;padding:0px; line-height:auto; color:#3f3f3f; font-style: 13px;'>"
                  + marcadores[0][3] //NOMBRE DEL ESTUDIO
                  + "</h2>"
                  + "<p style='margin: 15px 0px; padding:0px; line-height:auto; font-style: 12px; color: #999999;'><i> "
                  + marcadores[0][4] //DIRECCIÓN 1 DEL ESTUDIO
                  + "</i></p>"
                  + "<p><a class='comollegar' href='"
                  + marcadores[0][5] // TELEFONO DEL ESTUDIO
                  + "' target='_blank'>¿Cómo llegar?</a></p>"
                  )
                ;
              infowindow.open(map, marker);
            }
          }
        })(marker, i));
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>