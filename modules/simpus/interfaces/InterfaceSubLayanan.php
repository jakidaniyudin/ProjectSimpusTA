<?php
interface InterfaceSubLayanan
{
    public function loadForm($load, $session, $encryption, $model);
    public function get_session($session, $encryption);
    public function loadModel($model, $index);
}