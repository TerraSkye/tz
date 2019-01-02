<?php

use Prooph\EventStore\EventData;
use Prooph\EventStore\EventId;

/**
 * Created by PhpStorm.
 * User: sjoerd
 * Date: 31-12-18
 * Time: 16:31
 */
class VillageIsEstablished extends EventData
{

    public function __construct(JsonSerializable $data, JsonSerializable $metaData)
    {
        $eventId = EventId::generate();
        $eventType = \implode(\array_slice(\explode('\\', \get_class(static::class)), -1));
        parent::__construct($eventId, $eventType, true, json_encode($data), json_encode($metaData));
    }


    private $location;

    /**
     * @param Location $location
     * @return VillageIsEstablished
     */
    public static function withData(Location $location)
    {
        //todo meta data resolver from middleware.
        $self = new self($location,null);
        $self->location = $location;
        return $self;
    }



    public function getLocation() : Location {
        $location = new Location();
    }

    public function getVillageId() :\Travian\Village\VillageId{
        return new \Travian\Village\VillageId();
    }


}