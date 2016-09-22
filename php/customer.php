<?php

/**
 * Stored in session to indicate logged in user.
 */
class Customer
{
    public $id;
    public $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

?>