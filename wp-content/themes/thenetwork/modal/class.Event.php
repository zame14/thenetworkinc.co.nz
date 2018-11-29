<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/17/2018
 * Time: 9:24 AM
 */
class Event extends NetworkBase
{
    public function getLocation()
    {
        return $this->getPostMeta('location');
    }
    public function getDate()
    {
        return $this->getPostMeta('date');
    }
    public function getTime()
    {
        return $this->getPostMeta('time');
    }
    public function getImage()
    {
        return $this->getPostMeta('event-image');
    }
}