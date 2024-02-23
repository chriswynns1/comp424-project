#!/bin/bash

# update package lists
sudo apt-get update

# install apache
sudo apt-get install apache2 -y

# restart apache
sudo service apache2 restart