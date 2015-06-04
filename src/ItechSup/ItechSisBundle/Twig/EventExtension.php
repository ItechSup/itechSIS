<?php

namespace ItechSup\ItechSisBundle\Twig;

class EventExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('json_events', array($this, 'jsonEventConvert')),
        );
    }

    public function jsonEventConvert($events)
    {
        $data = array();
        foreach ($events as $event) {
            $data[] = array(
                'title' => $event->getTitle(),
                'start' => $event->getStartTime()->format(\DateTime::RFC3339),
                'end'   => $event->getEndTime()->format(\DateTime::RFC3339),
            );
        }
        return json_encode($data);
    }

    public function getName()
    {
        return 'event_extension';
    }
}
