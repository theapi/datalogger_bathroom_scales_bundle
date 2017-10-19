<?php

namespace Theapi\BathroomScalesBundle\Service;


use Theapi\BathroomScalesBundle\Event\WeightInsertEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Theapi\BathroomScalesBundle\Service\People\People;
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
      WeightInsertEvent::NAME => 'handleWeightInsert',
    ];
  }

  public function handleWeightInsert(WeightInsertEvent $event) {
    print 'Event weight: ' . $event->getWeight()->getKg() . " for ";
    $people = $this->getContainer()->get(PeopleService::class);
    print $people->getPersonByWeight($event->getWeight()->getKg()) . "\n";
  }

  /**
   * @return ContainerInterface
   */
  public function getContainer() {
    return $this->container;
  }

}
