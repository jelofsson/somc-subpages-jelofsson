<?php
/**
 * Provide a list of subpages for current page
 * 
 * This is the list-item section of each subpages-level post.
 *
 * @link       https://github.com/jelofsson/somc-subpages-jelofsson
 * @package    WordPress
 * @subpackage Component
 * @since      1.0.0
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 */
?>
<a alt="'click here to read more.'" href="<?php echo $post->guid ?>"><?php echo Helper_Text::Truncate(get_the_title( $post->ID )) ?></a>
<?php if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail( $post->ID ) ) ) :  ?>
    <?php echo get_the_post_thumbnail( $post->ID, array(32,32)); ?>
<?php endif; ?>