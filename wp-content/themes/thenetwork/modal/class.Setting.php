<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/25/2018
 * Time: 3:46 PM
 */
class Setting extends NetworkBase
{
    public function hideCTA()
    {
        return $this->getPostMeta('hide-cta');
    }
}