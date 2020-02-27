<?php

namespace Toiba\FullCalendarBundle\Service;

use Toiba\FullCalendarBundle\Entity\FullCalendarEvent;

interface SerializerInterface
{
    /**
     * @param FullCalendarEvent[] $events
     *
     * @return string json
     */
    public function serialize(array $events);
}
