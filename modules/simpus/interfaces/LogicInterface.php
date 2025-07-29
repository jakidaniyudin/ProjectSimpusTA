<?php

interface LogicInterface
{
    public function get($post);
    public function set($post, $data);
    public function create($post, $id_record_detail);
    public function update($post, $id_record_detail);
    public function delete($post);
}