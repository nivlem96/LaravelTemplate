php artisan down || true
git pull
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan migrate --force
php artisan db:seed --force
php artisan cache:clear
php artisan auth:clear-resets
php artisan route:clear
npm ci
npm run prod
php artisan up
