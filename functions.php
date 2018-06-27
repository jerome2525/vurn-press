<?php
/**
 * functions.php
 * @package Simple Agent Press
 */


/**
 * Loads a Genesis setup file
 */

require get_stylesheet_directory() . '/inc/init.php';
$Init = new Init;

/**
 * Loads Custom Query
 */
require get_stylesheet_directory() . '/inc/post-type-list/post-type-list.php';

/**
 * Loads a Reusable functions
 */
require get_stylesheet_directory() . '/inc/reusable.php';
$Reusable = new Reusable;

/**
 * Loads a Genesis setup file
 */
require get_stylesheet_directory() . '/inc/load-assets.php';
$Load_Assets = new Load_Assets;


/**
 * Loads a Genesis setup file
 */
require get_stylesheet_directory() . '/inc/form-ajax.php';
$Form_Ajax = new Form_Ajax;

/*
 * Loads acf Customfields functions
 */
require get_stylesheet_directory() . '/inc/admin/meta-boxes.php';
$Meta_Boxes = new Meta_Boxes;

/*
 * Loads header specific functions
 */
require get_stylesheet_directory() . '/inc/structure/header.php';
$Header = new Header;

/*
 * Loads footer specific functions
 */
require get_stylesheet_directory() . '/inc/structure/footer.php';
$Footer = new Footer;

/*
 * Loads Custom Post Type functions
 */
require get_stylesheet_directory() . '/inc/admin/post_types.php';
$Post_Types = new Post_Types;


