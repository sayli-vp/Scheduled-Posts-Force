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

class BaseService
{
    public $loader;

    public function __construct(Scheduled_Posts_Force_Loader $loader)
    {
        $this->loader = $loader;
    }
}