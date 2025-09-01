cd /home/forge/autofactorng.com

git pull origin $FORGE_SITE_BRANCH
$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Prevent concurrent php-fpm reloads...
touch /tmp/fpmlock 2>/dev/null || true
( flock -w 10 9 || exit 1
    echo 'Reloading PHP FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9</tmp/fpmlock

npm ci && npm run build

if [ -f artisan ]; then
    $FORGE_PHP artisan optimize
    $FORGE_PHP artisan migrate --force
fi