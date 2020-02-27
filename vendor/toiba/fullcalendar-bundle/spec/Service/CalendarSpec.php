<?php

namespace spec\Toiba\FullCalendarBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;
use Toiba\FullCalendarBundle\Service\SerializerInterface;

class CalendarSpec extends ObjectBehavior
{
    function let(SerializerInterface $serializer, EventDispatcherInterface $dispatcher)
    {
        $this->beConstructedWith($serializer, $dispatcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Toiba\FullCalendarBundle\Service\Calendar');
    }

    function it_gets_a_json_string(
        SerializerInterface $serializer,
        EventDispatcherInterface $dispatcher,
        CalendarEvent $calendarEvent,
        Event $event
    ) {
        $startDate = new \DateTime();
        $endDate = new \DateTime();
        $events = [$event];
        $json = '{ [events: foo] }';

        $dispatcher
            ->dispatch(CalendarEvent::SET_DATA, Argument::type('Toiba\FullCalendarBundle\Event\CalendarEvent'))
            ->shouldBeCalled()
            ->willReturn($calendarEvent);

        $calendarEvent->getEvents()->shouldBeCalled()->willReturn($events);

        $serializer->serialize($events)->shouldBeCalled()->willReturn($json);

        $this->getData($startDate, $endDate, [])->shouldReturn($json);
    }
}
