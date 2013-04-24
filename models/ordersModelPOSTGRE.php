<?php

require_once LIBS . 'Model.php';

class OrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getList($place, $date, $user_id) {
        $place = filter_var($place, FILTER_SANITIZE_SPECIAL_CHARS);
        $user_id = filter_var($user_id, FILTER_SANITIZE_SPECIAL_CHARS);
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
        $sql = $this->db->prepare("SELECT order_id, place_id, place_name,  date, user_id, ( firstname ||  ' ' || lastname ) AS name, time
                                    FROM ( SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
                                    FROM orders o, places p
                                    WHERE  o.date < (date(?) + 28 )
                                    AND o.date >= DATE( ? )
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    ORDER BY place_name ASC) AS orders
                                    LEFT OUTER JOIN users ON user_id = id");
        if ($sql->execute(array($date->format('Y-m-d'), $date->format('Y-m-d')))) {
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
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id as place_id, p.name AS place_name, date, o.user_id, ( firstname ||  ' ' || lastname ) AS name, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
                                    FROM orders o, places p, users u
                                    WHERE o.user_id = :id
                                    AND u.id = o.user_id
                                    " . $placeSQL . "
                                    AND p.id = o.place_id
                                    AND o.date < (date(:date) + 28 )
                                    AND o.date >= DATE( :date )
                                    ORDER BY place_name ASC");
        if ($sql->execute(array(":id" => filter_var($id, FILTER_SANITIZE_NUMBER_INT), ":date" => $date->format('Y-m-d')))) {
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

    public function getUserList() {
        $sql = $this->db->prepare("SELECT id, ( firstname ||  ' ' || lastname ) AS name FROM users");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function getOrder($id) {
        $sql = $this->db->prepare("SELECT o.id AS order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, to_char( o.order_start, 'HH24:MI' ) AS order_start, to_char( o.order_end, 'HH24:MI' ) AS order_end
                                    FROM orders o, places p
                                    WHERE o.id = ?
                                    AND p.id = o.place_id");
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
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
        $sql = $this->db->prepare("SELECT o.order_id, o.place_id, o.place_name, o.date, u.id, ( firstname ||  ' ' || lastname ) AS name, o.time
                                    FROM users u LEFT JOIN (
                                    SELECT o.id AS order_id, o.place_id AS place_id, p.name AS place_name, date, o.user_id, ( to_char( o.order_start, 'HH24:MI' ) ||  '-' || to_char( o.order_end, 'HH24:MI' ) ) AS time
                                    FROM orders o, places p
                                    WHERE p.id = o.place_id
                                    AND o.date = (SELECT date FROM orders WHERE id = :id )
                                    ) AS o ON u.id = o.user_id");
        if ($sql->execute(array("id" => filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
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
        $date = DateTime::createFromFormat('j.n.y', filter_var($_POST["date"], FILTER_SANITIZE_SPECIAL_CHARS));
        $sql = $this->db->prepare("INSERT INTO orders (place_id ,user_id ,date ,order_start ,order_end) 
            VALUES (?,?,?,?,?)");
        if ($sql->execute(array($_POST["place_id"], $user_id, $date->format("Y-m-d"), $_POST["start_hour"] . ":" . $_POST["start_min"] . ":00", $_POST["end_hour"] . ":" . $_POST["end_min"] . ":00"))) {
            return "Vuoro: ".$date->format("Y-m-d")." lisätty!";
        }
        return "Vuoron lisäys epäonnistui!";
    }

    public function updateOrder() {
        if ($_POST["user_id"] == "none") {
            $_POST["user_id"] = null;
        }
        $order_id = filter_var($_POST["order_id"], FILTER_SANITIZE_NUMBER_INT);
        $date = DateTime::createFromFormat('j.n.y', filter_var($_POST["date"], FILTER_SANITIZE_SPECIAL_CHARS));
        $sql = $this->db->prepare("UPDATE orders SET place_id = ? ,user_id = ?,date = ? ,order_start = ?,order_end = ?
            WHERE id = ?");
        if ($sql->execute(array($_POST["place_id"], $_POST["user_id"], $date->format("Y-m-d"), $_POST["start_hour"] . ":" . $_POST["start_min"] . ":00", $_POST["end_hour"] . ":" . $_POST["end_min"] . ":00", $order_id))) {
            $result = $this->getOrder($order_id);
            $resdate = new DateTime($result["date"]);
            return "Vuoro: " . $resdate->format('j.n.y') . ", " . $result["place_name"] . ", " . $result["order_start"] . "-" . $result["order_end"] . "  muokattu!";
        }
        return "Vuoron muokkaus epäonnistui!";
    }

    public function deleteOrder($id) {
        $toBeDeleted = $this->getOrder($id);
        $sql = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            $resdate = new DateTime($toBeDeleted["date"]);
            return "Vuoro: " . $resdate->format('j.n.y') . ", " . $toBeDeleted["place_name"] . ", " . $toBeDeleted["order_start"] . "-" . $toBeDeleted["order_end"] . "  poistettu!";
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
