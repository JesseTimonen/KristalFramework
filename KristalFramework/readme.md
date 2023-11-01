# Kristal Framework

Kristal Framework is a PHP-based architecture designed to furnish developers with a clean and straightforward MVC environment for website development.
The framework is publicly available under the MIT License, granting individuals the latitude to utilize, modify, and distribute it as they deem appropriate.



## Important

This project was initiated as a learning exercise to delve into the mechanics of PHP frameworks while allowing for some creative experimentation.
It is not designed for use in production environments. Please be advised that the framework may contain security vulnerabilities, and there is the possibility that updates to the framework may cease without notice.
As such, it is advised to use this framework strictly for exploratory or experimental applications.



## Server requirements

* PHP 7.4+
* Composer



## Database requirements

* PDO PHP extension



## Server

* Ideally Apache or litespeed server with .htaccess support
* May or may not work with nginx



## Installing

1. Upload the files (which are inside KristalFramework folder) to a server or local development environment.
2. Run 'composer install --prefer-dist --optimize-autoloader' on 'App/Backend/Core/' to install dependencies from composer.json file.

After completing these steps you should now be able to access the built-in demo page by going to your server's URL.



## Troubleshooting

If you have issues with navigating to pages, go to .htaccess file and change redirect path at the routing controller section from relative path

    RewriteRule ^(.+)$ index.php [L]
    
to a full path

    RewriteRule ^(.+)$ https://www.example.com/index.php [L]

As this is a personal project, compatibility with all systems out-of-the-box is not guaranteed.
Should you encounter any issues while utilizing the framework,
please do not hesitate to reach out via email at jesse.timonen@outlook.com.
Your feedback will aid in both resolving your issue and further refining the framework.



## Documentation

Documentation for the framework can be found [here](https://www.jessetimonen.fi/kristal/documentation)