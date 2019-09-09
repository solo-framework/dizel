#!/bin/bash

# docker run --rm --name php7 -v $(pwd):/app php7-afi-alpine bash -c "$@"

./run-in-container.sh 'export APP_CONFIG=config/web.dev.php APP_DEBUG_MODE=true && php -S 0.0.0.0:9191 -t /app'
