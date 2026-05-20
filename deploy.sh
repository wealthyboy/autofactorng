cd /home/forge/autofactorng.com

git pull origin $FORGE_SITE_BRANCH
$FORGE_COMPOSER install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Fail fast if any PHP file has a malformed opening sequence like "<?phpnamespace".
if grep -RIn --include='*.php' '^<?phpnamespace' app config routes database bootstrap; then
    echo 'Deploy aborted: malformed PHP opening tag found.'
    exit 1
fi

# Quick syntax validation for critical model touched frequently in order flows.
$FORGE_PHP -l app/Models/Order.php

# Prevent concurrent php-fpm reloads...
touch /tmp/fpmlock 2>/dev/null || true
( flock -w 10 9 || exit 1
    echo 'Reloading PHP FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9</tmp/fpmlock

npm ci && npm run build

if [ -f artisan ]; then
    $FORGE_PHP artisan optimize
    $FORGE_PHP artisan migrate --force
fi