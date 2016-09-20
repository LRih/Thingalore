<?php

class Order
{
    public $id;
    public $date;
    public $status;

    function __construct($id, $date, $status)
    {
        // htmlspecialchars removes XSS threat
        $this->id = $id;
        $this->date = htmlspecialchars($date);
        $this->status = htmlspecialchars($status);
    }
}

?>