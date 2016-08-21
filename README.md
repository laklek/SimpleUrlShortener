# Simple Url Shortener
Just a quick project I'm making for my own use.

Edits are welcome.

Focus is 
- Compatibility with custom hostnames (for ex: http://myRaspPi or http://localhost)
- Custom protocols (skype:les.de?add)
- Portability of all the files and easy installation


# Installation

1. Upload the .htaccess and s.php to your webroot (like /var/www/html/)
2. Import short.sql to any of your databases or create a new one if you prefer
3. configure database settings in s.php

# Usage

I will be making an example.html but basically you have the following GET and POST calls to the s.php:

(%s = short url   %l = long url)

call                                                  method            description
http://my.site/s.php?u=%s                             GET               Goes to the stored long version of the url %s   
http://my.site/%s                                     GET               Goes to the stored long version of the url %s   
http://my.site/s.php?del=%s                           GET/POST          Deletes the short URL %s with it's long version   
http://my.site/s.php?short=%s&long=%l                 GET/POST          Creates a shortened url from %s to the remote %l
