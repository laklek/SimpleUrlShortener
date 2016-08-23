# Simple Url Shortener
Just a quick project I'm making for my own use.

Edits are welcome.

Focus is 
- Compatibility with custom hostnames (for ex: http://myRaspPi or http://localhost)
- Custom protocols (skype:les.de?add)
- Portability of all the files and easy installation
- Ability to record hits

# Requirements
- Apache (Tested on Apache/2.4.10 (Debian), nginx compatiblility not assured)
- php (Tested on php 5.6)
- mysql & php-mysql plugin
- rewrite apache mod enabled ( a2enmod rewrite ) (if you use a webhost, ask them to enable it if it isn't already)

# Installation

1. Download the project using git
    $ git clone https://github.com/don/cordova-plugin-hello.git
2. Upload/place the .htaccess and s.php to your webroot (like /var/www/html/) (if you use https:// edit it in .htaccess)
3. Import short.sql to any of your databases or create a new one if you prefer
4. configure database settings in s.php

# Usage

I will be making an example.html but basically you have the following GET and POST calls to the s.php:

(%s = short url   %l = long url)

```
call                                          method            description
http://my.site/s.php?u=%s                     GET               Goes to the stored long version of the url %s   
http://my.site/%s                             GET               Goes to the stored long version of the url %s   
http://my.site/s.php?del=%s                   GET/POST          Deletes the short URL %s with it's long version   
http://my.site/s.php?short=%s&long=%l         GET/POST          Creates a shortened url from %s to the remote %l
```
