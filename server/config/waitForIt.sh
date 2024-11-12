#!/usr/bin/env bash

host="$1"
shift
cmd="$@"

until mysql -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" -e 'SELECT 1'; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "MySQL is up - executing command"
exec $cmd
