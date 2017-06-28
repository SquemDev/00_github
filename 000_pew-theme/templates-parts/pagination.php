<?php if (function_exists('pew_page_navi')) { // if expirimental feature is active ?>
	
	<?php pew_page_navi(); // use the page navi function ?>
	
<?php } else { // if it is disabled, display regular wp prev & next links ?>
	<ul class="total">
		<li class="left"><?php next_posts_link(_e('&laquo; Más resultados', 'theme ysf')) ?></li>
		<li class="right"><?php previous_posts_link(_e('Más resultados &raquo;', 'theme ysf')) ?></li>
	</ul>
<?php } ?>	