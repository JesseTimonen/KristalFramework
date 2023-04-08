<?php defined("ACCESS") or exit("Access Denied");

function displayMessage($message, $messageType, $return_link = false, $return_message = "Return")
{
    // Display message container with appropriate class
    echo "<div class='message-container {$messageType}-message'>";

    // Display Messages
    if (is_array($message))
    {
        $first = true;
        foreach ($message as $msg)
        {
            echo ($first) ? "<h2>$msg</h2>" : "<p>$msg</p>";
            $first = false;
        }
    }
    else
    {
        echo "<h2>$message</h2>";
    }

    // Display Return link
    if ($return_link === true)
    {
        echo "<p><a href='https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>$return_message</a></p>";
    }
    else if ($return_link !== false)
    {
        echo "<p><a href='$return_link'>$return_message</a></p>";
    }

    echo "</div>";

    if ($messageType == 'error' || $messageType == 'notification')
    {
        exit();
    }
}

function createError($message, $return_link = false, $return_message = "Return")
{
    displayMessage($message, 'error', $return_link, $return_message);
}

function createWarning($message)
{
    displayMessage($message, 'warning');
}

function createNotification($message, $return_link = false, $return_message = "Return")
{
    displayMessage($message, 'notification', $return_link, $return_message);
}