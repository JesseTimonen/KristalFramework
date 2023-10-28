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
            $this->startSession($this->getClientIPAddress());
        }
    }


    function getClientIPAddress()
    {
        $ip_keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];

        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER)) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                        return $ip;
                    }
                }
            }
        }

        return 'unknown';
    }


    private function startSession($IP_address)
    {
        session_name(SESSION_NAME);
        
        ini_set('session.cookie_secure', '1');
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_samesite', 'Strict');

        session_start();
        session_regenerate_id(true);


        // Restart if user's IP address doesn't match the original one
        if (!empty($_SESSION["IP_address"]))
        {
            if ($_SESSION["IP_address"] !== $IP_address)
            {
                $this->restart();
            }
        }
        else
        {
            $_SESSION["IP_address"] = $IP_address;
        }


        // Check session duration
        $this->afk_timeout(SESSION_AFK_TIMEOUT);
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
    private function afk_timeout($duration)
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