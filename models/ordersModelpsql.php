<?php

require_once LIBS . 'Model.php';

class OrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getList($date, $user_id) {
        if ($user_id == "all") {
            return $this->AllOrdersList($date);
        } else if ($user_id == "none") {
            return $this->getFreeOrders($date);
        }
        return $this->UsersOrdersList($date, $user_id);
    }

    public function AllOrdersList($date) {
        $sql = $this->db->prepare("SELECT order_id, place_id, place_name,  date, user_id, CONCAT( firstname, ' ', lastname ) AS name, time
FROM ( SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
FROM orders o, places p
WHERE p.id = o.place_id
AND o.date < DATE_ADD(:date, INTERVAL 4 WEEK )
AND o.date >= DATE( :date )
) AS orders
LEFT OUTER JOIN users ON user_id = id");
        if ($sql->execute(array(":date" => $date->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function UsersOrdersList($date, $id) {
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, CONCAT( u.firstname, ' ', u.lastname ) AS name, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
FROM orders o, places p, users u
WHERE o.user_id = :id
AND u.id = :id
AND p.id = o.place_id
AND o.date < DATE_ADD( :date, INTERVAL 4 WEEK )
AND o.date >= DATE( :date )");
        if ($sql->execute(array(":id" => $id, ":date" => $date->format('Y-m-d')))) {
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

    public function getFreeOrders($date) {
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
FROM orders o, places p
WHERE o.user_id IS NULL
AND p.id = o.place_id
AND o.date < DATE_ADD( :date, INTERVAL 4 WEEK )
AND o.date >= DATE( :date )");
        if ($sql->execute(array(":date" => $date->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getUserList() {
        $sql = $this->db->prepare("SELECT id, CONCAT(firstname, ' ', lastname) as name FROM users");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getOrder($id) {
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, CONCAT( u.firstname, ' ', u.lastname ) AS name, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
FROM orders o, places p, users u
WHERE o.id = :id
AND p.id = o.place_id
AND u.id = o.user_id
");
        if ($sql->execute(array(":id" => $id))) {
            return $sql->fetchAll();
        }
        return null;
    }
    
    public function getPlaces() {
                $sql = $this->db->prepare("SELECT id, name from places");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }
    
        public function getUsersForOrderDate($id) {
        $sql = $this->db->prepare("SELECT o.order_id, o.place_id, o.place_name, o.date, u.id, CONCAT( u.firstname, ' ', u.lastname ) AS name, o.time
FROM users u
LEFT JOIN (
SELECT o.id AS order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
FROM orders o, places p
WHERE p.id = o.place_id
AND o.date = (SELECT date FROM orders WHERE id = :id )
) AS o ON u.id = o.user_id");
        if ($sql->execute(array("id" => $id))) {
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
