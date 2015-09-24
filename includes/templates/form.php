<?php
/**
 * Provide a administration widget form-view for the plugin
 *
 * LICENSE: http://opensource.org/licenses/MIT
 *
 * @category   WP_Plugin
 * @package    CustomPostType_Widget
 * @subpackage CustomPostType_Widget/Includes/Templates
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @version    $Id:$
 * @link       https://github.com/jelofsson
 * @since      Version 1.0.0
 *
 */
?>
<p>
    <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
</p>