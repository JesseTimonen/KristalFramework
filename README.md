# Kristal Framework

Kristal Framework is PHP based framework which aims to offer developers clean and simple MVC environment where they can develope their websites.
Kristal Framework was released to the public under MIT license, which allows people to use, modify and share this framework as they wish.



## Important

This project was made to learn how PHP frameworks work and to have a little bit of fun. This is not a proper framework for real life application.
This framework may very well have plenty of security vulnerabilities and I will not be actively updating the framework to keep it secure.
Only use this framework to mess around with it's features.



## Installing

1. Upload the files (which are inside KristalFramework folder) to a server or developement environment.
2. Run composer install to install dependencies from app/composer.json file.

After completing these steps you should now be able to access the built-in demo page by going to your server's URL.



## Troubleshooting

If you have issues with navigating to pages, go to .htaccess file and change redirect path at the routing controller section from relative path

    RewriteRule ^(.+)$ index.php [L]
    
to a full path

    RewriteRule ^(.+)$ https://www.example.com/index.php [L]

As this is a personal project, I don't have the capability to make sure everything works with every system out from the gate,
so if you experience any issues with the framework please let me know by sending an email to jesse.timonen@outlook.com
so I can try to help you fix the issue and improve the framework.



## Documentation

Documentation for the framework can be found [here](https://www.jessetimonen.fi/kristal/documentation)
