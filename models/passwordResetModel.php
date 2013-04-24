<?php

require_once LIBS . 'Model.php';

class PasswordResetModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function resetPassword($email) {
        $sql = $this->db->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $sql->execute(array($email));
        $data = $sql->fetch();
        $count = $sql->rowCount();
        if ($count != 1) {
            return "Sähköpostia ei löytynyt!";
        }
        $randomString = sha1(uniqid(rand()));
        $password = substr($randomString, 0, 8);
        $hashedPassword = hash("sha256", $password . $data["username"]);
        if ($this->changePassword($data["id"], $hashedPassword) == true) {
            return $this->sendEmail($email, $data["username"], $password);
        } else {
            return "Salasanan vaihto epäonnistui! Tarkista tietokanta yhteydet.";
        }
    }

    private function changePassword($id, $password) {
        $sql = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $sql->execute(array($password, $id));
    }

    private function sendEmail($email, $username, $password) {
        $subject = "Uusi salasanasi työvuorolistalle";
$message = "Salasanan resetointi, Työvuorolista
----------------------------
Käyttäjätunnus ".$username."
Salasana: ".$password."
----------------------------
Tämä viesti on generoitu automaattisesti, ethän vastaa tähän.
Mikäli et pyytänyt salasanan resetointia, ota yhteyttä ylläpitoon.
"; 
 
          if(!mail($email, $subject, $message, "From: Työvuorolista")){
             die ("Sähköpostin lähetys epäonnistui, ota yhteyttä ylläpitoon!");
          }else{
                return "Uusi salasana on lähetetty sähköpostiisi!";
         }
        
    }

}

