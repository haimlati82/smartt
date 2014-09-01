<?php
function get_post_box_by_id($postId) {


	echo '<div class="box_detail">';
			 echo '<h3>'. get_the_title($postId->ID).'</h3>';
			 echo '<p>'. get_the_excerpt($postId->ID).'<p>';
			echo '</div>';
	echo'<div class="image_box">';
			 echo get_the_post_thumbnail($postId->ID,'thumbnail'); 
			echo'</div>';


}
function get_features() {
	$post_objects = get_field ( 'features' );
	
	 if( $post_objects ):	?>
<div class="features_boxs">
    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); 
       get_post_box_by_id($post);
     endforeach; ?>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?> 
<?php 
 endif;
}
function get_safety(){
$post_objects = get_field ( 'safety' );

	 if( $post_objects ):	?>
<div class="features_boxs">
    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); 
       get_post_box_by_id($post);
       vimeo_bottun($post);
     endforeach; ?>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?> 
<?php 
 endif;
}

function vimeo_field($postId){
	$vimeo = get_field('vimeo',$postId->ID);
	if($vimeo){
		echo $vimeo;
	}
}
function vimeo_bottun($postId){
	$vimeo = get_field('vimeo',$postId->ID);
	if($vimeo){
		echo '<a><span></span>Watch Video</a>';
	}
}