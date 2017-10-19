<?php

namespace Theapi\BathroomScalesBundle\Service\People;

/**
 * Class People
 *
 * @package Theapi\BathroomScalesBundle\Service\People;
 */
class PeopleService implements PeopleServiceInterface {

  private $data;

  /**
   * @param $json
   */
  public function setJson($json) {
    $this->data = json_decode($json);
  }

  /**
   * @inheritdoc
   */
  public function getPersonByWeight($weight) {
    reset($this->data);
    foreach ($this->data as $person) {
      if ($person[1] < $weight && $weight < $person[2]) {
        return $person[0];
      }
    }

    return $this->data[0];
  }

}
