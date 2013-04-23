<?php

class TreeCreator {

    private $array = array();
    private $count = 0;
    private $placeArray = array();

    public function buildTree($sqlData) {
        foreach ($sqlData as $key => $value) {
            $place = $value['place_id'];
            $this->placeArray[$place] = $value['place_name'];
            $tempDate = new DateTime($value['date']);
            $date = $tempDate->format('j.n.y');
            if ($place == null || $date == null) {
                continue;
            }
            if (array_key_exists("name", $value) && $value["name"] != null) {
                $data = array("order_id" => $value['order_id'], "name" => $value['name'], "time" => $value['time']);
            } else {
                $data = array("order_id" => $value['order_id'], "time" => $value['time']);
            }
            if (!key_exists($place, $this->array)) {
                $this->array[$place] = array();
            }
            if (!key_exists($date, $this->array[$place])) {
                $this->array[$place][$date] = array();
            }
            array_push($this->array[$place][$date], $data);
            $this->count++;
        }
        return $this;
    }

    public function getArray() {
        return $this->array;
    }

    public function getOrdersPlaceAndDate($place_key, $date) {
        if (key_exists($date, $this->array[$place_key])) {
            return $this->array[$place_key][$date];
        } else {
            return null;
        }
    }

    public function getPlaces() {
        return array_keys($this->array);
    }
    

    public function countOrders() {
        return $this->count;
    }
    
    public function getPlaceName($id) {
        return $this->placeArray[$id];
    }
    
    public function getPlaceKeys() {
        return array_keys($this->placeArray);
    }

}
