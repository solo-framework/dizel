#!/bin/bash

ISRUNNING=$(docker inspect -f '{{.State.Running}}' php7)

if [[ "$ISRUNNING" == "true" ]]; then
	docker exec -it php7 bash -c "$@"
else
	docker run --rm --name php7 -v $(pwd):/app php7-afi-alpine bash -c "$@"
fi