install laravel globally if you have never run a laravel app before
create a .env file in the root of your projrct folder
go to https://pusher.com/ and create an app to get app id, keys and secret
add the necessary credentials to your .env file, or ask for sample file via: https://www.upwork.com/freelancers/~012d7489e964a15135?mp_source=share
create sns_delivery_app database in phpmyadmin
run php artisan migrate or import tables from database/
if you ran migrations, seed the role and permissions seeder - php artisan db:seed --class=RolesAndPermissionsSeeder
run php artisan storage:link
run php artisan serve
run npm run dev
run php artisan queue:work (all 3 on a separate terminal tab)
