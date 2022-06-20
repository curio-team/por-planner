<?php

class Flash {
    public static function push($key, $value) {
        $values = Session::get($key, []);
        $values[] = $value;
        Session::flash($key, $values);
    }
}