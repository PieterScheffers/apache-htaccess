FROM php:apache

COPY ./docker/* /docker/

RUN /docker/enable_mod_rewrite.sh && \
	/docker/enable_mod_headers.sh
