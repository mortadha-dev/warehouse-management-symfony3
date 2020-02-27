# Documentation

**Symfony flex users skip steps 2 and 3** because they are done in the recipe

## Installation

1. [Download FullCalendarBundle using composer](#1-download-fullcalendarbundle-using-composer)
2. [Enable bundle](#2-enable-bundle)
3. [Add Routing](#3-define-routes)
4. [Create your listener](#4-create-your-listener)
5. [Add styles and scripts in your template](#5-add-styles-and-scripts-in-your-template)

### 1. Download FullCalendarBundle using composer

```sh
$ composer require toiba/fullcalendar-bundle
```

### 2. Enable bundle

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        //...
        new Toiba\FullCalendarBundle\FullCalendarBundle(),
    );
}
```

### 3. Define routes

```yaml
# app/config/routing.yml

toiba_fullcalendar:
    resource: "@FullCalendarBundle/Resources/config/routing.yaml"
```

### 4. Create your listener
You need to create a listener class to load your event data into the calendar.

This listener must be called when the event 'fullcalendar.set_data' is launched. For this reason, you will need to add this in your services.yml.
```yaml
# app/config/services.yml or config/services.yaml
services:
    # ...

    AppBundle\EventListener\FullCalendarListener:
        tags:
            - { name: 'kernel.event_listener', event: 'fullcalendar.set_data', method: loadEvents }
```

Then, create the listener class to add events to the calendar

See the [doctrine listener example](doctrine-listener.md)

```php
// src/AppBundle/EventListener/FullCalendarListener.php
<?php

namespace AppBundle\EventListener;

use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;

class FullCalendarListener
{
    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // You may want to make a custom query to populate the calendar
        
        $calendar->addEvent(new Event(
            'Event 1',
            new \DateTime('Tuesday this week'),
            new \DateTime('Wednesdays this week')
        ));

        // If the end date is null or not defined, it creates a all day event
        $calendar->addEvent(new Event(
            'Event All day',
            new \DateTime('Friday this week')
        ));
    }
}
```

### 5. Add styles and scripts in your template

Include the html template were you want to display the calendar:

```twig
{% block body %}
    {% include '@FullCalendarCalendar/calendar.html.twig' %}
{% endblock %}
```

Add styles and js. Click [here](https://fullcalendar.io/download) to see other css and js download methods

```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('bundles/fullcalendar/css/fullcalendar/fullcalendar.min.css') }}" />
{% endblock %}

{% block javascripts %}
    <script type="text/javascript" src="{{ asset('bundles/fullcalendar/js/fullcalendar/lib/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/fullcalendar/js/fullcalendar/lib/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/fullcalendar/js/fullcalendar/fullcalendar.min.js') }}"></script>
    
    {# <script type="text/javascript" src="{{ asset('bundles/fullcalendar/js/fullcalendar/locale-all.js') }}"></script> #}
{% endblock %}
```

## Basic functionalities

You may want to customize the FullCalendar javascript to meet your applications needs. To do this, you can copy the following settings and modify them according to your needs. For example, you can pass custom filters to your event listener by adding extra parameters to the filters array

```js
$(function () {
    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, basicWeek, basicDay'
        },
        lazyFetching: true,
        navLinks: true,
        eventSources: [
            {
                url: '/fc-load-events',
                type: 'POST',
                data: {
                    filters: {}
                },
                error: function () {
                    alert('There was an error while fetching FullCalendar!');
                }
            }
        ]
    });
});
```

## Extending Basic functionalities

```js
$(function () {
    $('#calendar-holder').fullCalendar({
        locale: 'fr',
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },
        businessHours: {
            start: '09:00',
            end: '18:00',
            dow: [1, 2, 3, 4, 5]
        },
        defaultView: 'agendaWeek',
        lazyFetching: true,
        navLinks: true,
        selectable: true,
        editable: true,
        eventDurationEditable: true,
        eventSources: [
            {
                url: '/fc-load-events',
                type: 'POST',
                data: {
                    filters: {}
                },
                error: function () {
                    // alert('There was an error while fetching FullCalendar!');
                }
            }
        ]
    });
});
```

## Troubleshoot AJAX requests

* To debug AJAX requests, show the Network monitor, then reload the page. Finally click on `fc-load-events` and select the `Response` or `Preview` tab
    - Firefox: `Ctrl + Shift + E` ( `Command + Option + E` on Mac )
    - Chrome: `Ctrl + Shift + I` ( `Command + Option + I` on Mac )
