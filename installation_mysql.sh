#!/bin/bash

# update package lists
sudo apt-get update

# install mysql
sudo apt-get install mysql-server

# restart mysql
sudo service mysql restart