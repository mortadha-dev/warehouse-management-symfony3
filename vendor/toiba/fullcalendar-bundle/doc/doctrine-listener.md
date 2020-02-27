# Doctrine listener

After [registering the listener as a service](index.md#4-create-your-listener)

You need to inject doctrine `EntityManagerInterface` to the event listener

```php
// src/EventListener/FullCalendarListener.php
<?php

namespace App\EventListener;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;

class FullCalendarListener
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change b.beginAt by your start date in your custom entity
        $bookings = $this->em->getRepository(Booking::class)
            ->createQueryBuilder('b')
            ->andWhere('b.beginAt BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        foreach($bookings as $booking) {

            // this create the events with your own entity (here booking entity) to po
            $bookingEvent = new Event(
                $booking->getTitle(),
                $booking->getBeginAt(),
                $booking->getEndAt() // If the end date is null or not defined, it creates a all day event
            );

            /*
             * Optional calendar event settings
             *
             * For more information see : Toiba\FullCalendarBundle\Entity\Event
             * and : https://fullcalendar.io/docs/event-object
             */
            // $bookingEvent->setUrl('http://www.google.com');
            // $bookingEvent->setBackgroundColor($booking->getColor());
            // $bookingEvent->setCustomField('borderColor', $booking->getColor());

            // finally, add the booking to the CalendarEvent for displaying on the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}
```

Finish installation by adding [css and js](index.md#5-add-styles-and-scripts-in-your-template)

## Next steps
[Link the calendar to a CRUD to allow add, edit & show events](doctrine-crud.md)
