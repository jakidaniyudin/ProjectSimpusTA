<?php 


interface TokenStorageInterface  {
    public function save ($propertis);
    public function update ($propertis, $id);
    public function get ($parameters);
    public function delete($parameters);
}