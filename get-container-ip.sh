#!/bin/bash

IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' php7)

echo http://$IP:9191