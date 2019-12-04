# symfony4test

cp .env.example .env

set variables db_user and db_name

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate

php bin/console doctrine:fixtures:load