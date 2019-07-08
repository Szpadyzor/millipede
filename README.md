# millipede
Short project for random selection Code Review order

### tech info
docker + nginx + php7-fpm + phalcon

## Project install

1. Clone project from github
2. Go to millipede folder
3. run: ```docker-compose build```
4. run: ```docker-compose up```
5. put in your `hosts` file: ```172.19.0.4 dev.millipede.local```

After that millipede should be available from ```172.19.0.4``` or ```http://dev.millipede.local```

### Email send

If you want to send email to developers with millipede you have to set in file `millipede/docker/php-fpm/ssmtp/ssmtp.conf`:
1. `root=example@gmail.com` email address
2. `AuthUser=example` auth username
3. `AuthPass=123456`  auth password