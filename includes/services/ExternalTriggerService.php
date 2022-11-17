<?php
/**
 * @since      1.0.0
 * @package    Scheduled_Posts_Force
 * @subpackage Scheduled_Posts_Force/includes/services
 * @developer  Sayli
 * @author     viaprestige <viaprestige.agency@gmail.com>
 */

namespace services;

use Scheduled_Posts_Force_Loader;

class ExternalTriggerService extends BaseService
{
    const SCHEDULED_POSTS_FORCE_ROUTE = '/scheduled-posts-force';

    public function __construct(Scheduled_Posts_Force_Loader $loader)
    {
        parent::__construct($loader);
        $loader->add_filter('rewrite_rules_array', $this, 'my_insert_rewrite_rules');
        $loader->add_action('wp_loaded', $this, 'my_flush_rules');
        $loader->add_filter('template_include', $this, 'include_template');
    }

    function my_insert_rewrite_rules($rules): array
    {
        $newRules = array();
        $newRules[self::SCHEDULED_POSTS_FORCE_ROUTE] = 'index.php';
        return $newRules + $rules;
    }

    function my_flush_rules()
    {
        $rules = get_option('rewrite_rules');
        if (!isset($rules[self::SCHEDULED_POSTS_FORCE_ROUTE])) {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
        }
    }

    public function include_template($template)
    {
        if (isset($_GET['publish_missed_future_posts']) && $_GET['publish_missed_future_posts']) {
            wp_send_json(ScheduledPostsService::publish_missed_posts(true), 200);
            exit();
        }
        return $template;
    }

}