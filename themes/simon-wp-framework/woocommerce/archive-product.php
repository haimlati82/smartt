<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
<div id="container">
<div id="content" role="main">
	<?php
	 woocommerce_breadcrumb();

	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$attributes = get_post_meta($product->id);
					//echo set_prod_class();
					?>
					<div class="cat-box-warp" data-category="<?php echo set_prod_class() ?>" >
					<?php get_prod_icon_set()?>
					
					<a class="cat-box-images-link" href="<?php echo the_permalink($product->ID)?>">
					<?php get_all_prod_image();?>
					</a>
					<a href="<?php echo the_permalink($product->ID)?>"><h3><?php echo the_title();?></h3></a>
					<div class="prod-colors"><?php  get_prod_color() ?></div>
					<p><?php  echo $product->get_price_html();  ?></p>
					<?php set_color_array(); ?>
					
					
					</div>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		</div>
		<div class="cat-sidebar">
		<?php get_color_chackboxs();?>
<?php dynamic_sidebar( 'widget-cat' ); ?>
	</div>
	</div>




<?php get_footer( 'shop' ); ?>