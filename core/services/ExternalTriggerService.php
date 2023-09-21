<?php
/**
 * @since      1.0.0
 * @package    Scheduled_Posts_Force
 * @subpackage Scheduled_Posts_Force/includes/services
 * @developer  Sayli
 * @author     viaprestige <viaprestige.agency@gmail.com>
 */

namespace scheduledpostsforce\core\services;


use scheduledpostsforce\core\Scheduled_Posts_Force_Loader;

class ExternalTriggerService extends BaseService
{
    const SCHEDULED_POSTS_FORCE_ROUTE = '/scheduled-posts-force';

    const SCHEDULED_POSTS_FORCE_REWRITE_RULES_OPTION_NAME = 'scheduled_posts_force_rewrite_rules_flushed';

    public function __construct(Scheduled_Posts_Force_Loader $loader)
    {
        parent::__construct($loader);
        $this->loader->add_action('init', $this, 'insert_rewrite_rules');
        $this->loader->add_action('template_redirect', $this, 'handle_request');
    }

    function insert_rewrite_rules()
    {
        global $wp_rewrite;
        if (!array_key_exists(self::SCHEDULED_POSTS_FORCE_ROUTE, $wp_rewrite->endpoints)) {
            add_rewrite_endpoint(self::SCHEDULED_POSTS_FORCE_ROUTE, EP_ROOT);
        }
        if (!get_option(self::SCHEDULED_POSTS_FORCE_REWRITE_RULES_OPTION_NAME)) {
            flush_rewrite_rules();
            update_option(self::SCHEDULED_POSTS_FORCE_REWRITE_RULES_OPTION_NAME, true);
        }
    }

    public function handle_request()
    {
        try {
            global $wp_query;
            if (isset($wp_query->query_vars['scheduled-posts-force']) || $wp_query->query_vars['pagename'] == 'scheduled-posts-force') {
                wp_send_json(ScheduledPostsService::publish_missed_posts(true), 200);
            } else {
                return;
            }
        } catch (\Exception $exception) {
            wp_send_json(['error' => $exception->getMessage()], 400);
        }
        exit();
    }

}