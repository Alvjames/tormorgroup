#!/bin/sh
set -eu

upload_root=/var/www/html/uploads
mkdir -p "$upload_root/backoffice/bank-transfers"
chown www-data:www-data \
  "$upload_root" \
  "$upload_root/backoffice" \
  "$upload_root/backoffice/bank-transfers"

exec docker-php-entrypoint "$@"
