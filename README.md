# docker-aegea
Dockerized Aegea blog engine: [RU](https://blogengine.ru) or [EN](http://blogengine.me/).

This container plays nicely with https://github.com/jwilder/nginx-proxy nginx docker container.


The build addresses fundamental flaw of having DB credentials encrypted in the configuration file and adds workaround to entrypoint to read credentials from DATABASE_URL, encrypt and save to the settings.psa file.

## Build

Change VERSION in docker-compose.yml to build new Aegea blog engine version and run

    docker-compose build
    
    
You can skip build process and use instead
    
    docker-compose pull
   

## Usage

    docker-compose up -d
    
Open http://localhost in browser and proceed with instructions. Use root as username, egeya as database name and password.


![Aegeya installation screenshot](/docs/install-screenshot.png)


This docker-compose.yml stores mysql database in persistent volume ./data/mysql, and blog settings stored in 

- ./data/pictures
- ./data/themes
- ./data/user

to survive blog data between container recreation.
