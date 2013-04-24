<?php

class Validate {

    private $ordersFilter = array(
        "order_id" => array("filter" => FILTER_SANITIZE_NUMBER_INT),
        "place_id" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "user_id" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "start_hour" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "start_min" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "end_hour" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "end_min" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS),
        "date" => array("filter" => FILTER_SANITIZE_SPECIAL_CHARS)
    );

    public function __construct() {
        
    }

    public static function length($min, $max, $string) {
        if (strlen($string) < $min) {
            return "Antamasi syöte on liian lyhyt, minimipituus on " . $min;
        }
        if (strlen($string) > $max) {
            return "Antamasi syöte on liian pitkä, maksimipituus on " . $max;
        }
    }

    public function trim(&$value) {
        $value = trim($value);
    }
    
    public function getPostFilters($class_name) {
        return $this->ordersFilter;
    }

}

