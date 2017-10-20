<?php


namespace Theapi\BathroomScalesBundle\Entity;

/**
 * The data to be logged.
 *
 * @package Theapi\BathroomScalesBundle\Entity
 */
class DataPoint {

  protected $kg = 0;

  protected $mv = 0;

  protected $person = '';

  public function setWeight(Weight $weight) {
    $this->kg = $weight->getKg();
    $this->mv = $weight->getMv();

    return $this;
  }

  public function getKg() {
    return $this->kg;
  }

  public function getMv() {
    return $this->mv;
  }

  public function setPerson($name) {
    $this->person = $name;

    return $this;
  }

  public function getPerson() {
    return $this->person;
  }

}
