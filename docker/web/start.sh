#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
queue=${QUEUE_TYPE:-default}
env=${APP_ENV:-production}

#if [ "$env" != "local" ]; then
##    echo "Caching configuration..."
##    (cd /var/www/html && php bin/console cache:clear)
#fi

if [ "$role" = "app" ]; then
    chown -R www-data:www-data /var/www/
    chmod -R 750 /var/www/infomarket/
    exec /usr/sbin/apache2ctl -D FOREGROUND -f /etc/apache2/apache2.conf

elif [ "$role" = "queue" ]; then

    echo "Running the queue..."

elif [ "$role" = "scheduler" ]; then

    while [ true ]
    do
      sleep 30
    done

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
