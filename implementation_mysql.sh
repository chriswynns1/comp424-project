#!/bin/bash

# set up iptables 
# flush existing rules / set policies to ACCEPT
iptables -F
iptables -P INPUT ACCEPT
iptables -P FORWARD ACCEPT
iptables -P OUTPUT ACCEPT

# allow incoming traffic on 3306 
iptables -A INPUT -p tcp --dport 3306 -j ACCEPT

# save the configuration / restart iptables
service iptables save
service iptables restart

echo "iptables configuration complete."

# MySQL database configuration
DB_NAME="comp424"
DB_USER="admin"
DB_PASSWORD="pleasechangeme123"

# SQL queries to create database and table
SQL_SCRIPT=$(cat <<EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME;
USE $DB_NAME;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    bday DATE,
    email VARCHAR(100),
    password VARCHAR(100),
    security_question_1 VARCHAR(255),
    security_answer_1 VARCHAR(255),
    security_question_2 VARCHAR(255),
    security_answer_2 VARCHAR(255),
    security_question_3 VARCHAR(255),
    security_answer_3 VARCHAR(255)
);

FLUSH PRIVILEGES;
EOF
)

# Execute SQL queries
mysql -u root -e "$SQL_SCRIPT"

# Create a new user with a password and require password change on the next login
if [ -n "$DB_USER" ] && [ -n "$DB_PASSWORD" ]; then
    CREATE_USER_SCRIPT="CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';"
    ALTER_USER_SCRIPT="ALTER USER '$DB_USER'@'localhost' PASSWORD EXPIRE;"
    mysql -u root -e "$CREATE_USER_SCRIPT$ALTER_USER_SCRIPT"
fi

echo "MySQL database setup complete."
