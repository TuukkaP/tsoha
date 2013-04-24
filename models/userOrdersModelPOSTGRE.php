<?php

require_once LIBS . 'Model.php';

class userOrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getList($place, $date, $user_id) {
        $place = filter_var($place, FILTER_SANITIZE_STRING);
        $id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
        if ($place != "all") {
            $placeSQL = "AND o.place_id = " . filter_var(trim($place), FILTER_SANITIZE_NUMBER_INT);
        } else {
            $placeSQL = "";
        }
        $sql = $this->db->prepare("SELECT o.id as order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, ( firstname ||  ' ' || lastname ) AS name, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
FROM orders o, places p, users u
WHERE o.user_id = :id
AND u.id = o.user_id
" . $placeSQL . "
AND p.id = o.place_id
AND o.date < (date(:date) + 28 )
AND o.date >= DATE( :date )
ORDER BY place_name ASC");
        if ($sql->execute(array(":id" => $user_id, ":date" => $date->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getWeekdays() {
        return array("Viikonpaivat", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai", "Sunnuntai");
    }

    public function getDate($inputDate) {
        $inputDate = filter_var($inputDate, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($inputDate == null) {
            $date = new DateTime('last monday');
        } else {
            $tempDate = DateTime::createFromFormat('j.n.y', $inputDate);
            $date = $tempDate->modify("-" . ($tempDate->format("N") - 1) . " day");  // palauttaa viikon ensimmäisen päivän eli annetusta päivämäärästä ko. viikon maanantain
        }
        return $date;
    }

    public function getFreeOrders($place, $date) {
        $place = filter_var($place, FILTER_SANITIZE_STRING);
        $date = filter_var($date, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($place != "all") {
            $placeSQL = "AND o.place_id = " . filter_var(trim($place), FILTER_SANITIZE_NUMBER_INT);
        } else {
            $placeSQL = "";
        }
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
                                    FROM orders o, places p
                                    WHERE o.user_id IS NULL
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    AND o.date < (date(:date) + 28 )
                                    AND o.date >= DATE( :date )
                                    ORDER BY place_name ASC");
        if ($sql->execute(array(":date" => $date->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getOrder($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, to_char( o.order_start, 'HH24:MI' ) AS order_start, to_char( o.order_end, 'HH24:MI' ) AS order_end
                                    FROM orders o, places p
                                    WHERE o.id = :id
                                    AND p.id = o.place_id");
        if ($sql->execute(array(":id" => $id))) {
            return $sql->fetch();
        }
        return null;
    }

    public function getPlaces() {
        $sql = $this->db->prepare("SELECT id, name from places ORDER BY name ASC");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

}

//POSTGRES SYNTAKSI
//SELECT order_id, place_id, place_name,  date, user_id, ( firstname ||  ' ' || lastname ) AS name, time
//FROM ( SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
//FROM orders o, places p
//WHERE p.id = o.place_id
//AND o.date < (date'2013-04-01' + 28 )
//AND o.date >= DATE(date'2013-04-01' )
//) AS orders
//LEFT OUTER JOIN users ON user_id = id;
