<?php

namespace Theapi\BathroomScalesBundle\Event;

use Theapi\BathroomScalesBundle\Entity\DataPoint;
use Symfony\Component\EventDispatcher\Event;

/**
 * The datapoint.prepared event is dispatched when a datapoint is ready to be saved.
 */
class DataPointPreparedEvent extends Event {

  const NAME = 'datapoint.prepared';

  protected $dp;

  public function __construct(DataPoint $dp) {
    $this->dp = $dp;
  }

  public function getDataPoint() {
    return $this->dp;
  }

}
