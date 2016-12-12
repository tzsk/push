<?php
namespace Tzsk\Push\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Push
 *
 * @see  Tzsk\Push\Pusher
 */
class Push extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tzsk-push';
    }

}