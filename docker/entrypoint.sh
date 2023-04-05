#!/bin/sh
composer install --no-interaction
bin/console c:c
bin/console d:d:c --if-not-exists
bin/console d:m:m --no-interaction
bin/console d:f:l --no-interaction
chown -R www-data:www-data var/
apache2-foreground

exec "$@"
