#!/bin/sh
CONFIG=/var/www/html/user/settings.psa

if test -f "$CONFIG"; then
    cp "$CONFIG" "$CONFIG.bak"
    php override_database_settings.php "$CONFIG.bak" > "$CONFIG"
fi

set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- apache2-foreground "$@"
fi

exec "$@"
