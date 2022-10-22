#FROM php:8.1-cli
FROM composer
COPY . /var/getinstance/demopad
WORKDIR /var/getinstance/demopad/code
RUN bash ./scripts/setup.sh 
CMD [ "./scripts/Runner.sh" ]
