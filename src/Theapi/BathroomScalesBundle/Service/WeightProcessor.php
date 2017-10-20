<?php

namespace Theapi\BathroomScalesBundle\Service;


use Theapi\BathroomScalesBundle\Entity\DataPoint;
use Theapi\BathroomScalesBundle\Event\DataPointPreparedEvent;
use Theapi\BathroomScalesBundle\Event\WeightInsertEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Theapi\BathroomScalesBundle\Service\People\PeopleService;

class WeightProcessor implements ContainerAwareInterface, EventSubscriberInterface {

  /**
   * @var ContainerInterface|null
   */
  private $container;

  /**
   * @inheritDoc
   */
  public function setContainer(ContainerInterface $container = NULL) {
    $this->container = $container;
  }

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    return [
      'weight.insert' => 'handleWeightInsert',
    ];
  }

  public function handleWeightInsert(WeightInsertEvent $event) {
    $people = $this->getContainer()->get(PeopleService::class);
    $person = $people->getPersonByWeight($event->getWeight()->getKg());

    print 'Event weight: ' . $event->getWeight()->getKg() . " for ";
    print "$person\n";

    $dp = (new DataPoint())
      ->setWeight($event->getWeight())
      ->setPerson($person)
    ;

    // Send the event.
    $dispatcher = $this->getContainer()->get('event_dispatcher');
    $event = new DataPointPreparedEvent($dp);
    $dispatcher->dispatch('datapoint.prepared', $event);

  }

  /**
   * @return ContainerInterface
   */
  public function getContainer() {
    return $this->container;
  }

}
