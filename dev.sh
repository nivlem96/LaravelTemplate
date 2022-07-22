php artisan down || true
composer update
php artisan migrate --force
php artisan db:seed --force
php artisan cache:clear
php artisan auth:clear-resets
php artisan route:clear
npm update
npm run dev
php artisan up
