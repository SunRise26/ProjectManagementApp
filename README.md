# Yarandin test project

## Installation:
1. Build docker containers
RUN (cd docker && docker-compose build)

2. Run docker containers
RUN (cd docker && docker-compose up)
!!! MySql need some time to initialize on first launch (takes about 1-2 minutes). Please, wait for the following message:
[Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.22'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.

3. Generate composer vendor
RUN (cd yarandin-test && composer install)

4. Copy .env settings
RUN (cd yarandin-test && cp .env.example .env)
!!! Generally, it is completely configured. MAIL_* configurations configured to use special email for testing, so you can leave them as they are.

5. Migrations, seeders, etc
RUN (cd yarandin-test && php artisan migrate)
!!! Migration became quite long after "voyager" admin installation :)
RUN (cd yarandin-test && php artisan db:seed)
RUN (cd yarandin-test && php artisan passport:keys)
RUN (cd yarandin-test && php artisan key:generate)

6. Phew...
Now available on https://localhost (by default)
Admin: https://localhost/admin

## Admin Installation
1. php artisan voyager:install

2. set/create admin user:
set:    php artisan voyager:admin your@email.com
create: php artisan voyager:admin your@email.com --create
