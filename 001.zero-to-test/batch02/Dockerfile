#FROM php:8.1-cli
FROM composer
COPY . /var/getinstance/demopad
WORKDIR /var/getinstance/demopad/code
RUN bash ../setup.sh 
CMD [ "./vendor/bin/phpunit", "tests/"]
