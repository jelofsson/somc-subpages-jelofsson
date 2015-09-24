<?php
/**
 * Provide a list of subpages for current page
 *
 * @link       https://github.com/jelofsson
 * @package    WordPress
 * @subpackage Component
 * @since      1.0.0
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 */
?>
<?php the_shortlink( the_title(null,null,false), 'click here to read more.'); ?>
<?php if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail() ) ) :  ?>
        <?php the_post_thumbnail( array(32,32) ); ?>
<?php endif; ?>