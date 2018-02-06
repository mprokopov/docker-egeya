# docker-aegea
Dockerized Aegea blog engine: [RU](https://blogengine.ru) or [EN](http://blogengine.me/).

This container plays nicely with https://github.com/jwilder/nginx-proxy nginx docker container.

## Build

Change VERSION in docker-compose.yml to build new Aegea blog engine version and run

    docker-compose build

## Usage

    docker-compose up -d
    
Open http://localhost in browser and proceed with instructions.


This docker-compose.yml stores mysql database in persistent volume ./data/mysql, and blog settings stored in 

- ./data/pictures
- ./data/themes
- ./data/user

to survive blog data between container recreation.
