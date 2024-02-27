#!/bin/bash

# update package lists
sudo apt-get update

# install php and dependencies
sudo apt-get install php libapache2-mod-php php-mysql -y

# restart apache
sudo service apache2 restart