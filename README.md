# Yarandin test project

## Installation:

1. Build docker containers<br />
RUN (cd docker && docker-compose build)

2. Run docker containers<br />
RUN (cd docker && docker-compose up)<br />
!!! MySql need some time to initialize on first launch (takes about 1-2 minutes). Please, wait for the following message:<br />
[Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.22'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.

3. Generate composer vendor<br />
RUN (cd yarandin-test && composer install)

4. Copy .env settings<br />
RUN (cd yarandin-test && cp .env.example .env)<br />
!!! Generally, it is completely configured. MAIL_* configurations configured to use special email for testing, so you can leave them as they are.

5. Migrations, seeders, etc<br />
RUN (cd yarandin-test && php artisan migrate)<br />
!!! Migration became quite long after "voyager" admin installation :)<br />
RUN (cd yarandin-test && php artisan db:seed)<br />
RUN (cd yarandin-test && php artisan passport:keys)<br />
RUN (cd yarandin-test && php artisan key:generate)<br />

6. Phew...
Now available on https://localhost (by default)<br />
Admin: https://localhost/admin

## Admin Installation

1. php artisan voyager:install

2. set/create admin user:<br />
set:    php artisan voyager:admin your@email.com<br />
create: php artisan voyager:admin your@email.com --create

## Testing

1. .env.testing already prepared, just create "testing" database:<br />
(cd docker && docker-compose exec mysql mysql -u root --password=123456)<br />
CREATE DATABASE testing;
