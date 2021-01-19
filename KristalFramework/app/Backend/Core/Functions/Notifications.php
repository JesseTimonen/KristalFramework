<?php defined("ACCESS") or exit("Access Denied");


function createError($message, $return_link = false, $return_message = "Return")
{
    // Style for error container
    ?><style>
        .error-message {
            text-align: center;
            color: black;
            padding: 5% 0 5% 0;
            margin: 10%;
            border: solid 1px darkred;
            background-color: #f1f1f1;
        }
    </style><?php

    $error = "<div class = 'error-message'>";

    // Display Messages
    if (is_array($message))
    {
        $first = true;
        foreach ($message as $msg)
        {
            $error .= ($first) ? "<h2>$msg</h2>" : "<p>$msg</p>";
            $first = false;
        }
    }
    else
    {
        $error .= "<h2>$message</h2>";
    }

    // Display Return link
    if ($return_link === true)
    {
        $error .= "<p><a href = 'https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>$return_message</a></p>";
    }
    else if ($return_link !== false)
    {
        $error .= "<p><a href = '$return_link'>$return_message</a></p>";
    }

    $error .= "</div>";

    exit($error);
}



function createWarning($message)
{
    // Style for warning container
    ?><style>
        .warning-message {
            text-align: center;
            color: black;
            padding: 5% 0 5% 0;
            margin: 10%;
            border: solid 2px darkorange;
            background-color: #f1f1f1;
        }
    </style><?php

    // Display message
    echo "<div class = 'warning-message'><h2>$message</h2></div>";
}



function createNotification($message, $return_link = false, $return_message = "Return")
{
    // Style for notification container
    ?><style>
        .success-message {
            text-align: center;
            color: black;
            padding: 5% 0 5% 0;
            margin: 10%;
            border: solid 1px darkred;
            background-color: #f1f1f1;
        }
    </style><?php

    $notification = "<div class = 'success-message'>";

    // Display Messages
    if (is_array($message))
    {
        $first = true;
        foreach ($message as $msg)
        {
            $notification .= ($first) ? "<h2>$msg</h2>" : "<p>$msg</p>";
            $first = false;
        }
    }
    else
    {
        $notification .= "<h2>$message</h2>";
    }

    // Display Return link
    if ($return_link === true)
    {
        $notification .= "<p><a href = 'https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>$return_message</a></p>";
    }
    else if ($return_link !== false)
    {
        $notification .= "<p><a href = '$return_link'>$return_message</a></p>";
    }

    $notification .= "</div>";

    exit($notification);
}