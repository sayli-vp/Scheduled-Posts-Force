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
use WP_Query;

class ScheduledPostsService extends BaseService
{

    public function __construct(Scheduled_Posts_Force_Loader $loader)
    {
        parent::__construct($loader);
        $this->loader->add_action('wp_head', $this, 'publish_missed_posts');
    }

    public static function publish_missed_posts($return_response = false)
    {
        $data['missed_posts_length'] = 0;
        $data['response'] = 'WordPress Query object not running';
        try {
            if (is_front_page() || is_single()) {
                $now = time();
                $posts = new WP_Query(array(
                    'post_status' => 'future',
                    'post_type' => 'post',
                ));
                $posts = $posts->get_posts();
                foreach ($posts as $post) {
                    $post_time = strtotime($post->post_date_gmt);
                    if ($post_time < $now) {
                        wp_publish_post($post->ID);
                        $data['missed_posts_length']++;
                    }
                }
                $data['response'] = 'process executed';
            }
        } catch (\Exception $exception) {
            $data['response'] = $exception->getMessage();
        }
        return ($return_response) ? $data : true;
    }

}