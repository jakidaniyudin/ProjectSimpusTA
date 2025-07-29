<?php

require_once(APPPATH . 'modules/simpus/interfaces/LogicInterface.php');

abstract class BaseLogicAbstract implements LogicInterface
{
    abstract public function get($post);
    abstract public function set($post, $data);
    abstract public function create($post, $id_record_detail);
    abstract public function update($post, $id_record_detail);
    abstract public function delete($post);
}