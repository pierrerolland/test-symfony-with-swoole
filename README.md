# Dummy Symfony project with and without Swoole extension, just to compare

## Install

### Without Swoole
```
git clone https://github.com/pierrerolland/test-symfony-with-swoole
cd test-symfony-with-swoole/without-swoole/
docker-compose build
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php php bin/console d:s:u --force
```

### With Swoole
```
git clone https://github.com/pierrerolland/test-symfony-with-swoole
cd test-symfony-with-swoole/with-swoole/
docker-compose build
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php php bin/console d:s:u --force
docker-compose exec php bin/console swoole:server:run
```

## Fire
```
cd test-symfony-with-swoole/artillery/
npm install
./node_modules/.bin/artillery run config.yml
```
