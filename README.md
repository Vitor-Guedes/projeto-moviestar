# Projeto - MovieStar
Projeto de estudo, com base em um curso da udemy (PHP do Zero a Maestria) para demonstração de conhecimento. 

### Diferenças refente ao que foi ensindao no curso
* Docker e Docker Composer, para levantar o ambiente do desenvolvimento.
* Uso do laradocker para subir apenas os containers Nginx e Mysql
* Configuração do .config do Nginx para redirecionamento para public/index.php
* Lógica própria para identificar o template que deve ser usado de acordo com a url
* Setup das tabelas users, movies e reviews acessando /setup-db na url do projeto

### Config Nginx
```.conf
server {
    server_name dev.moviestar.test;
    root /var/www/moviestar/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }
}
```

### Banco de dados
Configuração de Conexão com banco de dados Mysql em:
 - settings/db.php