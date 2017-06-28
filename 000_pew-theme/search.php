<?php get_header(); ?>
			
<div id="content" class="clearfix row beachs">
	<div class="container">
		<div class="breadcrumb"></div>
		<div class="col col-lg-9 clearfix blogContent" role="main">
		
			<h1 class="tit mb20"><span><?php _e("Search Results for","wpbootstrap"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="col-md-4 item" id="post-<?php the_ID(); ?>" role="article">  
	            <a href="<?php the_permalink(); ?>" class="postThumb">
					<?php
                    		if ( has_post_thumbnail() ) {
								the_post_thumbnail('playa');
							}
							else {
								echo '<img width="260" height="112" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/no-aloj.png" />';
							}
							  ?>
	            </a>
	            <section class="text">
	            	<strong>
				    <?php $terms = get_the_terms( $post->ID , 'donde' ); 
                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term, 'donde' );
                        if( is_wp_error( $term_link ) )
                        continue;
                    echo '<a href="' . $term_link . '">' . $term->name . '</a>';
                    } ?>
	            	</strong>
	                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                <h4>
						<?php $resumen = get_post_meta(get_the_ID(), 'resumen', true); 
					    	if ($resumen) {   
							echo $resumen;
					     } ?>	
	                </h4>
	                <a href="<?php the_permalink(); ?>" class="sand uppercase alignCenter irA"><?php _e('Ver página', 'theme ysf'); ?></strong></a>
	            </section>
	        </article>  
			
			
			
			<?php endwhile; ?>	
			
			<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
				
				<?php page_navi(); // use the page navi function ?>
				
			<?php } else { // if it is disabled, display regular wp prev & next links ?>
				<nav class="wp-prev-next">
					<ul class="clearfix">
						<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
						<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
					</ul>
				</nav>
			<?php } ?>			
			
			<?php else : ?>
			
			<!-- this area shows up if there are no results -->
			
			<article id="post-not-found">
			    <header>
			    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
			    </header>
			    <section class="post_content">
			    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
			    </section>
			    <footer>
			    </footer>
			</article>
			
			<?php endif; ?>

		</div> <!-- end #main -->
	
	<?php get_sidebar(); // sidebar 1 ?>
	</div>

</div> <!-- end #content -->

<?php get_footer(); ?>