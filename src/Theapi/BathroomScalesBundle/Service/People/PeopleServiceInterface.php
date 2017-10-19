<?php
namespace Theapi\BathroomScalesBundle\Service\People;

interface PeopleServiceInterface {

  public function setJson($json);

  public function getPersonByWeight($weight);
}
