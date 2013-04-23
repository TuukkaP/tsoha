<?php

require_once LIBS . 'Model.php';

class OrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getList($place, $date, $user_id) {
        if ($user_id == "all") {
            return $this->everyUsersOrdersForPlaceAndDate($place, $date);
        } else if ($user_id == "none") {
            return $this->getFreeOrders($place, $date);
        }
        return $this->UsersOrdersList($place, $date, $user_id);
    }

    public function everyUsersOrdersForPlaceAndDate($place, $date) {
        if ($place != "all") {
            $placeSQL = "AND o.place_id = " . filter_var(trim($place), FILTER_SANITIZE_NUMBER_INT);
        } else {
            $placeSQL = "";
        }
        $sql = $this->db->prepare("SELECT order_id, place_id, place_name,  date, user_id, CONCAT( firstname, ' ', lastname ) AS name, time
                                    FROM ( SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
                                    FROM orders o, places p
                                    WHERE o.date < DATE_ADD(:date, INTERVAL 4 WEEK )
                                    AND o.date >= DATE( :date )
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    ORDER BY place_name ASC) AS orders
                                    LEFT OUTER JOIN users ON user_id = id");
        if ($sql->execute(array(":date" => $date->format('Y-m-d')))) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function UsersOrdersList($place, $date, $id) {
        if ($place != "all") {
            $placeSQL = "AND o.place_id = " . filter_var(trim($place), FILTER_SANITIZE_NUMBER_INT);
        } else {
            $placeSQL = "";
        }
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, CONCAT( u.firstname, ' ', u.lastname ) AS name, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
                                    FROM orders o, places p, users u
                                    WHERE o.user_id = :id
                                    AND u.id = o.user_id
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    AND o.date < DATE_ADD( :date, INTERVAL 4 WEEK )
                                    AND o.date >= DATE( :date )
                                    ORDER BY place_name ASC");
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

    public function getFreeOrders($place, $date) {
        if ($place != "all") {
            $placeSQL = "AND o.place_id = " . filter_var(trim($place), FILTER_SANITIZE_NUMBER_INT);
        } else {
            $placeSQL = "";
        }
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, CONCAT( TIME_FORMAT( o.order_start, '%H:%i' ) , '-', TIME_FORMAT( o.order_end, '%H:%i' ) ) AS time
                                    FROM orders o, places p
                                    WHERE o.user_id IS NULL
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    AND o.date < DATE_ADD( :date, INTERVAL 4 WEEK )
                                    AND o.date >= DATE( :date )
                                    ORDER BY place_name ASC");
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
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, TIME_FORMAT( o.order_start, '%H:%i' ) AS order_start, TIME_FORMAT( o.order_end, '%H:%i' ) AS order_end
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

    public function getUsersForOrderDate($id) {
        $sql = $this->db->prepare("SELECT o.order_id, o.place_id, o.place_name, o.date, u.id, CONCAT( u.firstname, ' ', u.lastname ) AS name, o.time
                                    FROM users u LEFT JOIN (
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

    public function saveOrder() {
        if ($_POST["user_id"] == "none") {
            $user_id = null;
        } else {
            $user_id = $_POST["user_id"];
        }
        $date = DateTime::createFromFormat('j.n.y', $_POST["date"]);
        $sql = $this->db->prepare("INSERT INTO orders (place_id ,user_id ,date ,order_start ,order_end) 
            VALUES (?,?,?,?,?)");
        if ($sql->execute(array($_POST["place_id"], $_POST["user_id"], $date->format("Y-m-d"), $_POST["start_hour"] . ":" . $_POST["start_min"] . ":00", $_POST["end_hour"] . ":" . $_POST["end_min"] . ":00"))) {
            $result = $this->getOrder($this->db->lastInsertId());
            return "Vuoro: " . (new DateTime($result["date"]))->format('j.n.y') . ", " . $result["place_name"] . ", " . $result["order_start"] . "-" . $result["order_end"] . " lisätty!";
        }
        return "Vuoron lisäys epäonnistui!";
    }

    public function updateOrder() {
        if ($_POST["user_id"] == "none") {
            $_POST["user_id"] = null;
        }
        $order_id = $_POST["order_id"];
        $date = DateTime::createFromFormat('j.n.y', $_POST["date"]);
        $sql = $this->db->prepare("UPDATE orders SET place_id = ? ,user_id = ?,date = ? ,order_start = ?,order_end = ?
            WHERE id = ?");
        if ($sql->execute(array($_POST["place_id"], $_POST["user_id"], $date->format("Y-m-d"), $_POST["start_hour"] . ":" . $_POST["start_min"] . ":00", $_POST["end_hour"] . ":" . $_POST["end_min"] . ":00", $order_id))) {
            $result = $this->getOrder($order_id);
            return "Vuoro: " . (new DateTime($result["date"]))->format('j.n.y') . ", " . $result["place_name"] . ", " . $result["order_start"] . "-" . $result["order_end"] . "  muokattu!";
        }
        return "Vuoron muokkaus epäonnistui!";
    }

    public function deleteOrder($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $toBeDeleted = $this->getOrder($id);
        $sql = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        if ($sql->execute(array($id))) {
            return "Vuoro: " . (new DateTime($toBeDeleted["date"]))->format('j.n.y') . ", " . $toBeDeleted["place_name"] . ", " . $toBeDeleted["order_start"] . "-" . $toBeDeleted["order_end"] . "  poistettu!";
        }
        return "Poistaminen epäonnistui!";
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
