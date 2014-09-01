<?php
add_filter ( 'add_to_cart_text', 'woo_custom_cart_button_text' ); // < 2.1
add_filter ( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' ); // 2.1 +
function woo_custom_cart_button_text() {
	return __ ( 'Buy Now', 'woocommerce' );
}
add_filter ( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab($tabs) {
	
	// Adds the new tab
	unset ( $tabs ['reviews'] );
	$tabs ['features_tab'] = array (
			'title' => __ ( 'Features', 'woocommerce' ),
			'priority' => 40,
			'callback' => 'woo_features_tab_content' 
	);
	$tabs ['safety_tab'] = array (
			'title' => __ ( 'Safety', 'woocommerce' ),
			'priority' => 45,
			'callback' => 'woo_safety_tab_content' 
	);
	$tabs ['faq_tab'] = array (
			'title' => __ ( 'FAQ', 'woocommerce' ),
			'priority' => 50,
			'callback' => 'woo_faq_tab_content' 
	);
	$tabs ['additional_information'] ['priority'] = 55;
	
	return $tabs;
}
function woo_features_tab_content() {
	get_features ();
}
function woo_safety_tab_content() {
	get_safety ();
}
function woo_faq_tab_content() {
	echo '<h2>FAQ</h2>';
	echo '<p>FAQ</p>';
}
// Remove each style one by one
add_filter ( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles($enqueue_styles) {
	unset ( $enqueue_styles ['woocommerce-general'] ); // Remove the gloss
	return $enqueue_styles;
}
add_filter ( 'woocommerce_get_availability', 'custom_get_availability', 1, 2 );
function custom_get_availability($availability, $_product) {
	// change text "In Stock' to 'SPECIAL ORDER'
	if ($_product->is_in_stock ())
		$availability ['availability'] = __ ( 'Available in stock', 'woocommerce' );
		
		// change text "Out of Stock' to 'SOLD OUT'
	if (! $_product->is_in_stock ())
		$availability ['availability'] = __ ( 'SOLD OUT', 'woocommerce' );
	return $availability;
}


remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

add_action ( 'woocommerce_product_meta_end', 'cj_show_attribute_links' );
function cj_show_attribute_links() {
	global $post;
	$attribute_names = array (
			'<ATTRIBUTE_NAME>',
			'<ANOTHER_ATTRIBUTE_NAME>' 
	); // Insert attribute names here
	
	foreach ( $attribute_names as $attribute_name ) {
		$taxonomy = get_taxonomy ( $attribute_name );
		
		if ($taxonomy && ! is_wp_error ( $taxonomy )) {
			$terms = wp_get_post_terms ( $post->ID, $attribute_name );
			$terms_array = array ();
			
			if (! empty ( $terms )) {
				foreach ( $terms as $term ) {
					$archive_link = get_term_link ( $term->slug, $attribute_name );
					$full_line = '<a href="' . $archive_link . '">' . $term->name . '</a>';
					array_push ( $terms_array, $full_line );
				}
				
				echo $taxonomy->labels->name . ' ' . implode ( $terms_array, ', ' );
			}
		}
	}
}
function get_prod_color() {
	global $post;
	$args = array (
			'attribute' => 'pa_color' 
	);
	$terms = wp_get_post_terms ( $post->ID, 'pa_color', $args );
	
	$count = count ( $terms );
	if ($count > 0) {
		echo '<div class="prod-colors-wrap">';
		
		foreach ( $terms as $term ) {
			$termId = $term->term_id;
			$taxonomy = $term->taxonomy;
			$background = get_field ( 'color', $taxonomy . '_' . $termId );
			echo '<span class="prod_color" style="background-color : ' . $background . ' ;"></span>';
		}
		echo '</div>';
	}
}
function get_prod_tags() {
	global $post;
	$args = array (
			'attribute' => 'product_tag'
	);
	$terms = wp_get_post_terms ( $post->ID, 'product_tag', $args );

	$count = count ( $terms );
	if ($count > 0) {
		foreach ( $terms as $term ) {
			//print_r($term);
			$termId = $term->term_id;
			$taxonomy = $term->taxonomy;
			$background = get_field ( 'tag_image', $taxonomy . '_' . $termId );
			echo '<div class="prod-icon-left" style="background : url(' . $background['url'] . ') ;"></div>';
		}
	}
}
function set_prod_class() {

	$prodClass= '';
	$args = array (
			'attribute' => array('product_tag','pa_color')
	);
	$terms = wp_get_post_terms ( get_the_ID(), array('product_tag','pa_color'), $args );
	$count = count ( $terms );
	if ($count > 0) {
		foreach ( $terms as $term ) {
			
			$termId = $term->term_id;
			$taxonomy = $term->slug;
			$prodClass .= $taxonomy.' ';
			
		}
	}
	return $prodClass;
}

function set_color_array() {
global $colorArray , $tagArray;
	$argsColor = array (
			'attribute' => 'pa_color'
	);
	$argsTag = array (
			'attribute' => 'product_tag'
	);
	$termsColor = wp_get_post_terms ( get_the_ID(), 'pa_color', $argsColor );
	$termsTag = wp_get_post_terms ( get_the_ID(), 'product_tag', $argsTag );
	
	
		foreach ( $termsColor as $term ) {
			
			$colorArray[] .= $term->name;
		}

	foreach ( $termsTag as $term ) {
			
			$tagArray[] .= $term->slug;
		}
	
	 
}

function get_color_chackboxs() {
global $colorArray ,$tagArray;

$result = array_unique($colorArray);
$result2 = array_unique($tagArray);



	
	$chackboxs= '';
	$args = array (
			'attribute' => 'pa_color'
	);
	$terms = wp_get_post_terms ( get_the_ID(), 'pa_color', $args );

		
		$chackboxs.= '<form class="color-filter" action="">';
		$chackboxs .= '<fieldset>';
		$chackboxs .= '<h3>';
		$chackboxs .= translate( 'Functionality', 'trick' );
		$chackboxs .= '</h3>';
		foreach ( $result2 as $chack2 ) {
		$chackboxs .= '<input type="checkbox" name="tags" id="'.$chack2.'" value="'.$chack2.'">'.$chack2.'<br>';
		}
		
		$chackboxs .= '</fieldset>';
		$chackboxs .= '<fieldset>';
		$chackboxs .= '<h3>';
		$chackboxs .= translate( 'Color', 'trick' );
		$chackboxs .= '</h3>';
		
		foreach ( $result as $chack ) {
			$chackboxs .= '<input type="checkbox" name="color" id="'.$chack.'" value="'.$chack.'">'.$chack.'<br>';	
		}
		$chackboxs .= '</fieldset>';
		$chackboxs.= '</form>';
	
	echo $chackboxs;
}


function get_all_prod_image() {
	 $productImg =  wp_get_attachment_url( get_post_thumbnail_id() );;
	echo '<div class="hs-wrapper">';

	 echo '<img src="'.$productImg.'" class="fisrt" />'; 
	if (have_rows ( 'productgallery' )) :
		$i = 0;
		while ( have_rows ( 'categorygallery' ) ) :
			the_row ();
			$images = get_sub_field ( 'catcolorgallery' );
			if (($images) && ($i < 1)) :
				?>


	            <?php foreach( $images as $image ): ?>

<img src="<?php echo $image['sizes']['medium']; ?>"
	alt="<?php echo $image['alt']; ?>" />
		<?php $i++;
		endforeach;
		endif;
		endwhile;
		endif;
		echo '</div>';
	}
function get_prod_icon_set(){

$icon = get_field('main_icon');
$icon_sale = get_field('sale_icon' , 'option');
$icon_best = get_field('best_sale_icon' , 'option');
$icon_discount = get_field('discount_icon' , 'option');

echo '<div class="prod-icons">';
get_prod_tags();


if($icon == "sale"){
	echo '<img class="prod-icon-right" src="'.$icon_sale['url'].'">';

}
if($icon == "best"){
	echo '<img class="prod-icon-right" src="'.$icon_best['url'].'">';

}
if($icon == "discount"){
	echo '<img class="prod-icon-right" src="'.$icon_discount['url'].'">';

}

echo '</div>';
	
}

function build_cookie(){
	$value = 'something from somewhere';
	setcookie('haimTest', $value, time()+3600);
}