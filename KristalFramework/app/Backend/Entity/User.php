<?php namespace Backend\Entity;
defined("ACCESS") or exit("Access Denied");

use Backend\Core\Entity;


class User extends Entity
{
    // Database information
    protected $database = "primary";

    // Entity information
    protected $table = "example_users";
    protected $primary_key = "id";
    protected $columns = array(
        "id" => "int(6) unsigned NOT NULL AUTO_INCREMENT",
        "email" => "varchar(50) NOT NULL UNIQUE",
        "username" => "varchar(20)",
        "role" => "varchar(20) NOT NULL"
    );

    // Table columns with default values
    public $id = null;
    public $email = "anonymous@anonymous.com";
    public $username = "anonymous";
    public $role = "user";

    // Construct entity (identifiers are used to call already existing entity)
    // For example: $user = new User("id", 5); Searches for entity with the given values
    // and $user = new User(); Creates a new entity
    public function __construct($identifier_key = null, $identifier_value = null)
    {
        parent::__construct([
            "database" => $database,
            "identifier_key" => $identifier_key,
            "identifier_value" => $identifier_value
        ]);
    }


    // ID
    function setID($id)
    {
        $this->id = $id;
    }
    function getID()
    {
        return $this->id;
    }


    // Email
    function setEmail($email)
    {
        $this->email = $email;
    }
    function getEmail()
    {
        return $this->email;
    }


    // Username
    function setUsername($username)
    {
        $this->username = $username;
    }
    function getUsername()
    {
        return $this->username;
    }


    // Role
    function setRole($role)
    {
        $this->role = $role;
    }
    function getRole()
    {
        return $this->role;
    }
}