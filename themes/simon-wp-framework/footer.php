<?php
/**
 * The template for Footer.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
?>

<div class="clear"></div>
<div class="outer_footer_wrap">
	<div class="inner_footer_wrap">
		<div class="content">
			<div style="clear: both"></div>
			<div id="footer">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer1") ) : ?>
        <?php endif; ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer2") ) : ?>
        <?php endif; ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer3") ) : ?>
        <?php endif; ?>
        <div style="clear: both"></div>
				<p>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?> | Powered By Simon WP Framework &amp; WordPress</p>
			</div>
		</div>
	</div>
</div>
<script src="<?php bloginfo('template_url')?>/inc/js/jquery.zoom.min.js"></script>
<script src="<?php bloginfo('template_url')?>/inc/js/js.js" ></script>


<?php wp_footer(); ?>

<script>
$(document).ready(function(){
	  jQuery('.slider-wrp .slides li').zoom();
	
	  jQuery('.slider-wrp .slides li').mouseleave(function(){
		  var style = {
				left:"0",
				top:"0",
				
			
			  };
		  
		  setTimeout( function(){
		  jQuery(this).children("img.zoomImg").css(style);
		  },100);
	  });

	  $('.hs-wrapper').hover( function(){
		  jQuery(this).cycle('resume');
			jQuery(this).cycle({
			    speed: 300,
			    manualSpeed: 100,
			    timeout:1000,
			});
	  },function(){
	 //alert("out");
	  jQuery(this).cycle('goto',0);
	  jQuery(this).cycle('pause');
	  
	 
	  });
	  
	  

		});



	  
// 	  var timer = null;
	  
// 	  function slidsow(){
// 		  $(".hs-wrapper > img:gt(0)").hide();
// 	      $('.hs-wrapper img:first-child')
// 	      .fadeOut()
// 	      .next()
// 	      .fadeIn()
// 	      .end()
// 	      .appendTo('.hs-wrapper');
// 	      timer =setTimeout(slidsow, 1000);

// 	         }
// 	  function startSetInterval() {
// 		    timer = setTimeout(slidsow,0);
// 		}
// 	  $('.hs-wrapper').hover(
// 			  function(){
				  
// 				 // $(this).children('.hs-wrapper').addClass('play');
// 				slidsow();
				  
				  
// 		},function(){
// 			// $(this).children('.hs-wrapper').removeClass('play');
// 		  clearTimeout(timer);
// 		  $('.hs-wrapper > img').appendTo('.hs-wrapper').css('display','none');
// 		  $('.hs-wrapper .fisrt').prependTo('.hs-wrapper').css('display','block');
// 		  //console.log(slidsowhtml);
		 

// 		});
	

// $('.slider-wrp .slides li img').mouseenter(function(){
// 	var imgs = $(this).attr('src');
	
// 	var imw = $(this).attr("width");
// 	var imh = $(this).attr("height");
// 	$(this).css('width' , imw + 'px');
	
// 	 $('.slider-wrp .slides ').on( "mousemove", function( event ){
		
// 	        var x = event.pageX - this.offsetLeft ;
// 	        var y = event.pageY - this.offsetTop;
// 	        console.log(x);
	       

// 	        $(this).children('img').css({transform: 'translateY('+y+'px) translateX('+x+'px)'});
// 	    });  
	
// });
// $('.slider-wrp .slides li img').mouseleave(function(){
// 	 $(this).css({transform: 'translateY(0px) translateX(0px)'});
	
// });

</script>

</body>
</html>