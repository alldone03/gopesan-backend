#!/bin/bash


sudo /opt/lampp/lampp start
gnome-terminal -- bash -c "cd /media/alldone/Data/learnReactJS/gps2fend && code . && yarn dev"
gnome-terminal -- bash -c "php artisan serve"




