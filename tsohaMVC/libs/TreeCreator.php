<?php

class TreeCreator {

    private $array = array();
    private $userArray = array();
    private $count = 0;

    public function buildTree($sqlData) {
        foreach ($sqlData as $key => $value) {
            $place = $value['place_name'];
            $date = (new DateTime($value['date']))->format('j.n.y');
            $data = array("order_id" => $value['order_id'], "worker" => $value['worker'], "time" => $value['time']);
            if (!array_key_exists($value['id'], $this->userArray)) {
                $this->userArray[$value['id']] = $value['worker'];
            }
            if ($place == null || $date == null) {
                continue;
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

    public function getOrdersPlaceAndDate($place, $date) {
        if (key_exists($date, $this->array[$place])) {
            return $this->array[$place][$date];
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

    public function getUserList() {
        return $this->userArray;
    }

}
