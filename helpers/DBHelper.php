<?php

class DBHelper
{
    private static $db;

    public function getDBInstance()
    {
        return self::$db ?? new mysqli('127.0.0.1'. 'root', '', 'viktor');
    }
}