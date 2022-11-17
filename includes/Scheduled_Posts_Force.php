<?php

/**
 * @link       https://viaprestige-agency.com
 * @since      1.0.0
 * @package    Scheduled_Posts_Force
 * @subpackage Scheduled_Posts_Force/includes
 * @developer  Sayli
 * @author     viaprestige <viaprestige.agency@gmail.com>
 */

use services\ExternalTriggerService;
use services\ScheduledPostsService;


class Scheduled_Posts_Force
{

    protected $loader;
    protected $plugin_name;
    protected $version;


    public function __construct()
    {
        if (defined('SCHEDULED_POSTS_FORCE_VERSION')) {
            $this->version = SCHEDULED_POSTS_FORCE_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'scheduled-posts-force';
        $this->load_dependencies();
    }


    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/Scheduled_Posts_Force_Loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/services/BaseService.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/services/ScheduledPostsService.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/services/ExternalTriggerService.php';
        $this->loader = new Scheduled_Posts_Force_Loader();
        $this->load_services();


    }

    public function load_services()
    {
        new ScheduledPostsService($this->loader);
        new ExternalTriggerService($this->loader);
    }

    public function run()
    {
        $this->loader->run();
    }

    public function get_plugin_name(): string
    {
        return $this->plugin_name;
    }

    public function get_version(): string
    {
        return $this->version;
    }

}
