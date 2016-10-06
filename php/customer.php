<?php

/**
 * Stored in session to indicate logged in user.
 */
class Customer
{
    public $id;

    public $fname;
    public $lname;
    public $address;

    public $email;
    public $phone;

    public $isVerified;


    function __construct($id, $fname, $lname, $address, $email, $phone, $isVerified)
    {
        $this->id = $id;

        $this->fname = htmlspecialchars($fname);
        $this->lname = htmlspecialchars($lname);
        $this->address = htmlspecialchars($address);

        $this->email = htmlspecialchars($email);
        $this->phone = $phone;

        $this->isVerified = $isVerified;
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
            $row["address"],
            $row["email"],
            $row["phone"],
            $row["is_verified"] == 1
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