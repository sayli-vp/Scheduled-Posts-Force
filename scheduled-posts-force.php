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
 * Version:           1.0.1
 * Author:            viaprestige
 * Author URI:        https://viaprestige-agency.com
 * License:           MIT
 */


use scheduledpostsforce\core\Scheduled_Posts_Force;

if (!defined('WPINC')) {
    die;
}
const SCHEDULED_POSTS_FORCE_VERSION = '1.0.1';
const SCHEDULED_POSTS_FORCE_PLUGIN_NAME = 'scheduled-posts-force';
require plugin_dir_path(__FILE__) . 'core/Scheduled_Posts_Force.php';
function run_scheduled_posts_force()
{
    $plugin = new Scheduled_Posts_Force();
    $plugin->run();
}

run_scheduled_posts_force();
