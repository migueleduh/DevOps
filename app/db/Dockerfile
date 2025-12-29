FROM  mysql:8.0-debian

ENV TZ=America/Sao_Paulo

ENV MYSQL_ALLOW_EMPTY_PASSWORD=True

COPY ./inovatech_db.sql /docker-entrypoint-initdb.d/
