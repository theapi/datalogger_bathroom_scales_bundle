<?php

namespace Theapi\BathroomScalesBundle\Service;


use Theapi\BathroomScalesBundle\Event\DataPointPreparedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DataPointLogService implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    return [
      'datapoint.prepared' => 'handlePrepared',
    ];
  }

  public function handlePrepared(DataPointPreparedEvent $event) {
    print 'Event to log - weight: '
      . $event->getDataPoint()->getKg() . " for "
      . $event->getDataPoint()->getPerson()
      . ', Mv : ' . $event->getDataPoint()->getMv()
      . "\n"
    ;

    // @todo: Save to the configured data stores, db, google sheets, csv etc.

  }

}
