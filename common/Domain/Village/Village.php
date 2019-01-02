<?php
/**
 * Created by PhpStorm.
 * User: sjoerd
 * Date: 31-12-18
 * Time: 16:29
 */

namespace Travian\Village;


use Entity;
use Prooph\EventStore\EventData;
use Village\BuildingFinished;

class Village
{

    use \AggragteRoot;
    /**
     * @var VillageId
     */
    private $villageId;
    private $location;

    private $population;

    private function __construct()
    {
    }

    public static function establish(\Location $location)
    {
        $self = new self();
        $self->location = $location;

        $self->recordThat(\VillageIsEstablished::withData($location));
        return $self;
    }

    public function enQueueBuilding(\UpgradeBuilding $command) : void{

    }

    public function buildingFinished(\BuildingFinished $command) : void{

    }

    public function demolishBuilding(\DemolishBuilding $command) : void{

    }





    public function whenVillageIsEstablished(\VillageIsEstablished $e)
    {
        $this->villageId = $e->getVillageId();
        $this->location = $e->getLocation();
    }

    public function whenBuildingisBuild(BuildingFinished $e){
        $this->population += $e->getPopulation();
    }

    public function sameIdentityAs(Entity $other): bool
    {
        return \get_class($this) === \get_class($other) && $this->villageId->sameValueAs($other->userId);
    }
    /**
     * Apply given event
     */
    protected function apply(EventData $e): void
    {
        $handler = $this->determineEventHandlerMethodFor($e);
        if (!\method_exists($this, $handler)) {
            throw new \RuntimeException(\sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                \get_class($this)
            ));
        }
        $this->{$handler}($e);
    }

    protected function determineEventHandlerMethodFor(EventData $e): string
    {
        return 'when' . \implode(\array_slice(\explode('\\', \get_class($e)), -1));
    }
}