<?php

/**
 * Security Service for an eCommerce Application.
 *
 * Updated By: Bill Hughes
 * Date: 2/6/2020
 * 
 * Original Author: Mark
 * 
 */
include_once 'db_connect.php';

class SecurityService extends db_connect
{
    // My private class variables
    private $username = "";
    private $password = "";

    /**
     * SecurityService constructor.
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Authenticate a user.
     *
     * @return bool True if authentication passes else returns False.
     */
    public function authenticate()
    {
        // Run Business Rules on User Credentials
        if($this->username === "" || $this->password === "")
        {
            return false;
        }
        $sql = "SELECT * FROM users WHERE Username='". $this->username . "' AND Password='" . $this->password . "'";
        
        $results = $this->connect()->query($sql);
        $row = $results->fetch_assoc();
        $numRows = $results->num_rows;
        if ($numRows == 1)
        {
            $userID = $row["ID_user"];
            
            $sql2 = "SELECT * FROM tbl_roles WHERE users_ID_user='". $userID . "' AND role_type='ADMIN'";
            $results2 = $this->connect()->query($sql2);
            $numRows2 = $results2->num_rows;
            if ($numRows2 == 1) {
                $_SESSION["admin"] = true;
            }
            else {
                $_SESSION["admin"] = false;
            }
            return true;
        }
        else {
            echo "Error";
            $_SESSION["admin"] = false;
            return false;
        }
    }
}





