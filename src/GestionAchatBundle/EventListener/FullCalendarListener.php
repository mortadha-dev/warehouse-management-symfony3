<?php
/**
 * Created by PhpStorm.
 * User: I.O.I
 * Date: 2/27/2019
 * Time: 2:03 PM
 */

namespace GestionAchatBundle\EventListener;
use GestionAchatBundle\Entity\Fournisseur;

use Doctrine\ORM\EntityManagerInterface;
use GestionAchatBundle\Entity\Commande;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FullCalendarListener
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }


    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change b.beginAt by your start date in your custom entity
        $bookings = $this->em->getRepository(Commande::class)
            ->createQueryBuilder('b')
            ->andWhere('b.date BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d'))
            ->setParameter('endDate', $endDate->format('Y-m-d'))
            ->getQuery()->getResult();

        foreach($bookings as $booking) {

            // this create the events with your own entity (here booking entity) to po
            $bookingEvent = new Event(
                $booking->getLibelleCommande(),
                $booking->getDate() // If the end date is null or not defined, it creates a all day event
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
            $bookingEvent->setUrl(
                $this->router->generate('commande_show', array(
                    'id' => $booking->getId(),
                ))
            );
            // finally, add the booking to the CalendarEvent for displaying on the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}