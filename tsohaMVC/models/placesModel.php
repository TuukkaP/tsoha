<?php

require_once LIBS . 'Model.php';

class PlacesModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function placesList() {
        $sql = $this->db->prepare("SELECT * FROM places");
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return null;
    }

    public function create($data) {
        $sql = $this->db->prepare('INSERT INTO places (name, address, info) 
            VALUES (?,?,?)');
        if ($sql->execute(array($data['name'], $data['address'], $data['info']))) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $sql = $this->db->prepare('DELETE FROM places WHERE id = ?');
        if ($sql->execute(array($id))) {
            return true;
        }
        return false;
    }

    public function getPlace($id) {
        $sql = $this->db->prepare('SELECT id,name,address,info FROM places WHERE id = ?');
        if ($sql->execute(array($id))) {
            return $sql->fetch();
        }
        return null;
    }
    
        public function editSave($data) {
        $sql = $this->db->prepare('UPDATE places SET name = ?,address = ?,info = ? WHERE id = ?');
        if ($sql->execute(array($data['name'], $data['address'], $data['info'], $data['id'] ))) {
            return true;
        }
        return false;
    }

}

