# docker-egeya
Dockerized Egeya blogging enging https://blogengine.ru

This container plays nicely with https://github.com/jwilder/nginx-proxy nginx docker container.

## Build

Change VERSION in docker-compose.yml to build new EGEYA blog engine version and run

    docker-compose build

## Usage

    docker-compose up -d
    
Open http://localhost in browser and proceed with instructions.
