<?php

use Travian\Village\VillageId;

/**
 * Created by PhpStorm.
 * User: sjoerd
 * Date: 31-12-18
 * Time: 17:01
 */

class ProductionProjection
{



    public function whenVillageIsEstablished(VillageId $id,\VillageIsEstablished $e){
        \Village\BuildingFinished::withData();

    }



    public function whenBuildingUpgraded(\BuildingUpgraded $event){

    }

}