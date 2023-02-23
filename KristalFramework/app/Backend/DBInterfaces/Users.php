<?php namespace Backend\DBInterfaces;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Database;

/*=================================================================================================================*\
|  This is an interface type of an entity, this class functions as a interface of your database table,              |
|  Allowing you to access, modify and delete the data within your database using function specified in this class.  |
\*=================================================================================================================*/

class Users extends Database
{
    private static $instance = null;
    protected $database = "primary";
    protected $table;
    protected $columns;
    protected $primary_key;


    public function __construct()
    {
        $this->table = "example_users";
        $this->primary_key = "id";
        $this->columns = array(
            "id" => "int(6) unsigned NOT NULL AUTO_INCREMENT",
            "email" => "varchar(50) NOT NULL UNIQUE",
            "username" => "varchar(20)",
            "role" => "varchar(20) NOT NULL"
        );

        parent::__construct(["database" => $this->database]);
        
        // Check does table exist, and create new if not found
        $this->confirmTable();

        // Reset the table by uncommenting the following line
        // $this->dropTable();
    }


    // Singleton
    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new Users();
        }

        return self::$instance;
    }


    /* ========================================================================================*\
    |  Below you can create your custom function to perform database queries and other actions  |
    |  Here are few examples, feel free to delete them and create your own                      |
    \* ========================================================================================*/


    // Create new user
    public function createUser($email, $username)
    {
        // Check does user already exist
        if ($this->doesUserExist($email))
        {
            return false;
        }

        // Insert new user to database
        return $this->table()->insert(["null", $email, $username, "user"]);
    }


    // Check if user already extsts in the database
    public function doesUserExist($email)
    {
        // Return result does email already exist in database
        return ($this->table()->doesExist("email", $email)) ? true : false;
    }


    // Get how many users there are in the database
    public function getUserCount()
    {
        return $this->table()->count();
    }


    // Retrieve information about user
    public function getUserInformation($email)
    {
        // return $this->table()->select(["email", "username", "role"])->where("email", $email)->get();
        return $this->table()->where("email", $email)->get();
    }


    // Get User's ID
    public function getID($email)
    {
        return $this->table()->where("email", $email)->value("id");
    }


    // Get User's Username
    public function getEmail($email)
    {
        return $this->table()->where("email", $email)->value("username");
    }


    // Get User's Role
    public function getRole($email)
    {
        return $this->table()->where("email", $email)->value("role");
    }


    // Get every user from database
    public function getUsers()
    {
        return $this->table()->getAll();
    }


    // Update user's information
    public function setUserInformation($email, array $new_info)
    {
        $this->table()->where("email", $email)->update($new_info);
    }


    // update user's email
    public function setEmail($id, $new_email)
    {
        $this->table()->where("id", $id)->update(["email" => $new_email]);
    }


    // update user's username
    public function setUsername($email, $new_username)
    {
        $this->table()->where("email", $email)->update(["username" => $new_username]);
    }


    // update user's role
    public function setRole($email, $new_role)
    {
        $this->table()->where("email", $email)->update(["role" => $new_role]);
    }


    // Delete user from database
    public function deleteUser($email)
    {
        $this->table()->where("email", $email)->delete();
    }


    // Delete every user from database
    public function deleteAll()
    {
        $this->table()->delete();
    }
}