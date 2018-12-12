FROM phalconphp/php-fpm:7-min

RUN apt-get update \
	&& apt-get install -y -q --no-install-recommends \
		ssmtp \
	&& apt-get clean \
    && rm -r /var/lib/apt/lists/*
