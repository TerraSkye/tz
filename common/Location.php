<?php
/**
 * Created by PhpStorm.
 * User: sjoerd
 * Date: 31-12-18
 * Time: 16:30
 */

class Location implements JsonSerializable
{
    public $x;

    public $y;

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [$this->x, $this->y];
    }
}