<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author ruben
 */
class Usuarios {
    
      public $nombreUsuario;
      public $apellidoUsuario;
      //public $nacionalidad;
      public $fotoUsuario;
 
    function __construct($nombreUsuario,$apellidoUsuario,$fotoUsuario) {
        $this->nombreUsuario = $nombreUsuario;
        $this->apellidoUsuario = $apellidoUsuario;
       // $this->nacionalidad = $nacionalidad;
        $this->fotoUsuario = $fotoUsuario;
       
    }
   
}
