FROM mprokopov/egeya:3254
MAINTAINER Maksym Prokopov<mprokopov@gmail.com>

COPY override_database_settings.php .
COPY entrypoint.sh /usr/local/bin

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
