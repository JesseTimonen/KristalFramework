<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");


class Session
{
    public function __construct()
    {
        $this->start();
    }


    public function start()
    {
        // Start session if it is not yet active
        if (!$this->isActive())
        {
            $this->startSession($this->getUsersUniqueIdentity());
        }
    }


    public function getClientIPAddress()
    {
        $IP_address = 'unknown';

        $keys = array('HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        foreach ($keys as $key) 
        {
            if (isset($_SERVER[$key])) 
            {
                $ip_list = explode(',', $_SERVER[$key]);
                foreach ($ip_list as $ip) 
                {
                    $ip = trim($ip); // remove any extra spaces
                    if (filter_var($ip, FILTER_VALIDATE_IP)) 
                    {
                        $IP_address = $ip;
                        return $IP_address;
                    }
                }
            }
        }
      
        return $IP_address;
    }


    public function getUserAgentHash()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    }


    public function getUsersUniqueIdentity()
    {
        // Use the IP address (consider using a more reliable method to get this)
        $IP_address = $this->getClientIPAddress();

        // Use the User-Agent string
        $user_agent = $this->getUserAgentHash();

        // Collect additional data if available
        $additional_data = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

        // Generate a id by hashing these together
        return hash('sha256', $IP_address . $user_agent . $additional_data);
    }


    private function startSession($visitor_identity)
    {
        session_name(SESSION_NAME);
        
        if (PRODUCTION_MODE) { ini_set('session.cookie_secure', '1'); }
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_samesite', 'Strict');

        session_start();
        session_regenerate_id(true);

        // Restart if user's IP address doesn't match the original one
        if (!empty($_SESSION["visitor_identity"]))
        {
            if ($_SESSION["visitor_identity"] !== $visitor_identity)
            {
                $this->restart();
            }
        }
        else
        {
            $_SESSION["visitor_identity"] = $visitor_identity;
        }

        // Check session duration
        $this->afkTimeout(SESSION_AFK_TIMEOUT);
        $this->timeout(SESSION_TIMEOUT);
    }
    

    public function end()
    {
        $this->removeAll();
        session_destroy();
    }


    public function restart()
    {
        $this->end();
        $this->start();
    }


    // Add variables to session
    public static function add($identifier, $value = null)
    {
        // Set single variable
        if (!is_array($identifier))
        {
            $_SESSION[$identifier] = $value;
            return;
        }

        // Set multiple variables
        foreach ($identifier as $key => $value)
        {
            $_SESSION[$key] = $value;
        }
    }


    // Remove variables from session
    public static function remove($key)
    {
        // Remove single variable
        if (!is_array($key))
        {
            unset($_SESSION[$key]);
            return;
        }

        // Remove multiple variables
        foreach ($key as $variable)
        {
            unset($_SESSION[$variable]);
        }
    }


    // Remove every variable from session
    public static function removeAll()
    {
        session_unset();
    }


    // Get variables from session
    public static function get($key, $return_object = true)
    {
        // Return single variable
        if (!is_array($key))
        {
            return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
        }

        // Return array of variables
        foreach ($key as $variable)
        {
            $variables[$variable] = (isset($_SESSION[$variable])) ? $_SESSION[$variable] : null;
        }

        return ($return_object) ? (object) $variables : $variables;
    }


    // Check if session is already active
    private function isActive()
    {
        if (php_sapi_name() !== "cli")
        {
            if (version_compare(phpversion(), "5.4.0", ">="))
            {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            }
            else
            {
                return session_id() === "" ? false : true;
            }
        }

        return false;
    }


    // End Session after x seconds has passed (specified in the config.php)
    private function timeout($duration)
    {
        if ($this->get("timeout") !== null)
        {
            $time = time() - (int)$this->get("timeout");

            if ($time > $duration)
            {
                $this->restart();
            }
        }
        else
        {
            $this->add("timeout", time());
        }
    }


    // End Session if user isn't active for x seconds (specified in the config.php)
    private function afkTimeout($duration)
    {
        if ($this->get("afk_timeout") !== null)
        {
            $time = time() - (int)$this->get("afk_timeout");

            if ($time > $duration)
            {
                $this->restart();
            }
        }

        $this->add("afk_timeout", time());
    }
}