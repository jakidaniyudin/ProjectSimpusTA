<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

interface interfacePopUp {
    public function load_popup($n = null, $propertis = null);
    public function list($propertis = null);
}