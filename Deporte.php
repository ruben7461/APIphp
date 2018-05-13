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
class Deporte {
   
     public $nombreDeporte;
    public $fotoDeporte;
   
 
    function __construct($nombreDeporte,$fotoDeporte) {
        $this->nombreDeporte = $nombreDeporte;
        $this->fotoDeporte = $fotoDeporte;
       
    }
 
}
