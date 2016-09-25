<?php

/**
 * Stored in session to indicate logged in user.
 */
class Customer
{
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $address;
    public $phone;

    function __construct($id, $fname, $lname, $email, $address, $phone)
    {
        $this->id = $id;
        $this->fname = htmlspecialchars($fname);
        $this->lname = htmlspecialchars($lname);
        $this->email = htmlspecialchars($email);
        $this->address = htmlspecialchars($address);
        $this->phone = $phone;
    }

    /**
     * Construct object from SQL row.
     */
    public static function fromRow($row)
    {
        return new Customer(
            $row["id"],
            $row["fname"],
            $row["lname"],
            $row["email"],
            $row["address"],
            $row["phone"]
        );
    }

    function name()
    {
        return $this->fname." ".$this->lname;
    }

    /**
     * Surround all lines with <p> tag.
     */
    function formattedAddress()
    {
        $lines = explode("\n", $this->address);

        $result = "";
        foreach ($lines as $line)
            $result .= "<p>".$line."</p>";

        return $result;
    }
}

?>