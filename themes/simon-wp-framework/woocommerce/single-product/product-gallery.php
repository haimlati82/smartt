<div class="product-gallery">
<?php
if (have_rows ( 'productgallery' )) :
	
	// loop through the rows of data
	$i = 1;
	
	while ( have_rows ( 'productgallery' ) ) :
		the_row ();
		
		// display a sub field value
		
		?>
<div class="warp-sld " id="warp-sld<?php echo $i?>">
       <?php
		$images = get_sub_field ( 'colorgallery' );
		if ($images) :
			?>
				<div class="carousel-wrp">
			<div id="carousel<?php echo $i?>" class="carousel flexslider">
				<ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li><img
						src="<?php echo $image['sizes']['thumbnail']; ?>"
						alt="<?php echo $image['alt']; ?>" /></li>
            <?php endforeach; ?>
        </ul>
			</div>
		</div>
		<div class="slider-wrp">
			<div id="slider<?php echo $i?>" class="flexslider">
				<ul class="slides">
            <?php foreach( $images as $image ): ?>
            
                <li><img src="<?php echo $image['url']; ?>" height="<?php echo $image['height']; ?>" width="<?php echo $image['width']; ?>"
						alt="<?php echo $image['alt']; ?>" />
						<p><?php echo $image['caption']; ?></p></li>
            <?php endforeach; ?>
        </ul>
			</div>
		</div>

   
		
		<?php endif;
		?></div>

	<script>
jQuery(window).load(function() {
	  // The slider being synced must be initialized first
	  jQuery('#carousel<?php echo $i?>').flexslider({
	    animation: "slide",
	    direction: "vertical",
	    controlNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 100,
	    itemMargin: 5,
	    asNavFor: '#slider<?php echo $i?>',
	    controlNav: false,              
	    directionNav: false, 
	  });
	 
	  jQuery('#slider<?php echo $i?>').flexslider({
	    animation: "fade",
	    controlNav: false,
	    animationLoop: false,
	    directionNav: false, 
	    slideshow: false,
	    sync: "#carousel<?php echo $i?>"
	  });
	  
	});
</script>		
<?php
		$i++;
	endwhile
	;


 

endif;

if (have_rows ( 'productgallery' )) :
	?><div class="gallery-links">
		<div class="gallery-links-warp"><?php
	// loop through the rows of data
	$i = 1;
	
	while ( have_rows ( 'productgallery' ) ) :
		the_row ();
		
		// display a sub field value
		$image_link = get_sub_field ( 'colorgallery' );
		//print_r($image_link);
		?>
		
<a class="img-gall-link" href="#warp-sld<?php echo $i?>"><img
				src="<?php echo $image_link[0]['sizes']['thumbnail']; ?>"
				alt="<?php echo $image_link[0]['alt']; ?>" /></a>
<?php
		$i++;
	endwhile
	;
	?></div>

<?php 

endif;


?>
</div>
</div>
<script>



jQuery(document).ready(function() {
	var numOfLink = jQuery('.gallery-links-warp a').length;
	var imageWidth = jQuery('.gallery-links-warp a').width();
	//var numXwidth = numOfLink * imageWidth + 150 +'px';
	//jQuery('.gallery-links-warp ').width(numXwidth);
	//console.log(numXwidth);

	jQuery("#warp-sld1").addClass('active');
	


	jQuery(".img-gall-link").click(function() {
		event.preventDefault();
		var url = jQuery(this).attr('href');
//alert(url);

		jQuery(".warp-sld").removeClass('active');
	
		jQuery(url).addClass('active');
		

			
    });
});


</script>