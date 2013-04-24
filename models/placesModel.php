<?php

require_once LIBS . 'Model.php';

class PlacesModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function placesList() {
        $sql = $this->db->prepare("SELECT * FROM places ORDER BY name, address");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return false;
    }

    public function create() {
        $data = array();
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['info'] = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
        $sql = $this->db->prepare('INSERT INTO places (name, address, info) 
            VALUES (?,?,?)');
        if ($sql->execute(array($data['name'], $data['address'], $data['info']))) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $sql = $this->db->prepare('DELETE FROM places WHERE id = ?');
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            return true;
        }
        return false;
    }

    public function getPlace($id) {
        $sql = $this->db->prepare('SELECT id,name,address,info FROM places WHERE id = ?');
        if ($sql->execute(array(filter_var($id, FILTER_SANITIZE_NUMBER_INT)))) {
            return $sql->fetch();
        }
        return false;
    }

    public function editSave($id) {
        $data = array();
        $data['id'] = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $data['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $data['info'] = filter_var($_POST['info'], FILTER_SANITIZE_STRING);
        $sql = $this->db->prepare('UPDATE places SET name = ?,address = ?,info = ? WHERE id = ?');
        if ($sql->execute(array($data['name'], $data['address'], $data['info'], $data['id']))) {
            return true;
        }
        return false;
    }

}

