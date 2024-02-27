#!/bin/bash

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