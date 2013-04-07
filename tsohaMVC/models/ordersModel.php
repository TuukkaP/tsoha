<?php

require_once LIBS . 'Model.php';

class OrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function currentWeekSetList($day, $id) {
        $tree = new TreeCreator();
        if ($id == "all") {
            $worker = "u.id";
        } else {
            $worker = $id;
        }
        $sql = $this->db->prepare("SELECT order_id, place_name, date, id, CONCAT( u.firstname, ' ', u.lastname ) AS worker, time FROM users u LEFT OUTER JOIN (SELECT DISTINCT o.id AS order_id, p.name AS place_name, date, o.user_id,  CONCAT( TIME_FORMAT( o.start, '%H:%i' ) , '-', TIME_FORMAT( o.end, '%H:%i' ) ) AS time
FROM orders o, places p, users u
WHERE o.user_id = ".$worker."
AND p.id = o.place_id
AND o.date < DATE_ADD(:monday , INTERVAL 4 WEEK )
AND o.date >= DATE(:monday)
ORDER BY o.date, p.name DESC) as taulu ON id = user_id");

        if ($sql->execute(array(":monday" => $day->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getWeekdays() {
        return array("Viikonpaivat", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai", "Sunnuntai");
    }

    public function getDate($inputDate) {
        if ($inputDate == null) {
            $date = new DateTime('last monday');
        } else {
            $tempDate = DateTime::createFromFormat('j.n.y', $inputDate);
            $date = $tempDate->modify("-" . ($tempDate->format("N") - 1) . " day");  // palauttaa viikon ensimmäisen päivän eli annetusta päivämäärästä ko. viikon maanantain
        }
        return $date;
    }

}