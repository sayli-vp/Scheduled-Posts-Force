<?php

/**
 * @link              https://viaprestige-agency.com
 * @since             1.0.0
 * @package           Scheduled_Posts_Force
 * @developer         Sayli
 *
 * @wordpress-plugin
 * Plugin Name:       Scheduled Posts Force
 * Plugin URI:        https://viaprestige-agency.com
 * Description:       Ensures the publication of planned posts using several tricks, including external cron.
 * Version:           1.0.0
 * Author:            viaprestige
 * Author URI:        https://viaprestige-agency.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       scheduled-posts-force
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
define('SCHEDULED_POSTS_FORCE_VERSION', '1.0.0');
require plugin_dir_path(__FILE__) . 'includes/Scheduled_Posts_Force.php';
function run_scheduled_posts_force()
{

    $plugin = new Scheduled_Posts_Force();
    $plugin->run();

}

run_scheduled_posts_force();
