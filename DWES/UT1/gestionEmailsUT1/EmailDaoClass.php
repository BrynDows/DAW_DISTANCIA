<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailDaoClass
 *
 * @author bryan
 */
include './ConexionClass.php';

class EmailDaoClass {

    private $terminal = null;

    public function __construct() {
        $this->terminal = ConexionClass::getConexion()->getTerminal();
    }

    function insertar(EmailBeanClass $emailBean) {
        $ok = false;
        
        $email = $emailBean->getEmail();
        $nombre = $emailBean->getNombre();
        $query = "INSERT INTO emails ( email, nombre) VALUES ('$email',  '$nombre')";

        if ($this->terminal->query($query) === TRUE) {
          $ok = true;
        } 
        
        $this->terminal->close();
        return $ok;
    }

    function consultarPK($emailID) {
        $query = "SELECT email, nombre FROM emails WHERE email = '$emailID'";
        $result = $this->terminal->query($query);
        $emailBean = new EmailBeanClass();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $emailBean->setEmail($row["email"]);
            $emailBean->setNombre($row["nombre"]);
        }
        $this->terminal->close();
        return $emailBean;
    }

    function consultarListado() {
        $query = "SELECT email, nombre FROM emails";
        $result = $this->terminal->query($query);
        $emails = new ArrayObject();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emailBean = new EmailBeanClass();
                $emailBean->setEmail($row["email"]);
                $emailBean->setNombre($row["nombre"]);
                $emails->append($emailBean);
            }
        }
        $this->terminal->close();
        
        return $emails;
    }

}
