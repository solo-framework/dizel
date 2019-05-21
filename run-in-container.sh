#!/bin/bash

docker run --rm --name php7 -v $(pwd):/app php7-afi-alpine bash -c "$@"
