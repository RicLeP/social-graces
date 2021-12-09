<?php

namespace Riclep\SocialGraces;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Riclep\SocialGraces\Skeleton\SkeletonClass
 */
class SocialGracesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'social-graces';
    }
}
