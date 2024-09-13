https://www.nginx.com/blog/using-free-ssltls-certificates-from-lets-encrypt-with-nginx/

```
$ apt-get update
$ sudo apt-get install certbot
$ apt-get install python-certbot-nginx
```

1. Zakładając, że zaczynasz od świeżej instalacji NGINX, użyj edytora tekstu, aby utworzyć plik w katalogu /etc/nginx/conf.d o nazwie domain-name.conf (czyli w naszym przykładzie www.example.com.conf) .

2. Określ nazwę swojej domeny (i jej warianty, jeśli istnieją) za pomocą dyrektywy nazwa_serwera:

```
server {
    listen 80 default_server;
    listen [::]:80 default_server;
    root /var/www/html;
    server_name example.com www.example.com;
}
```

3. Zapisz plik, a następnie uruchom to polecenie, aby sprawdzić składnię konfiguracji i ponownie uruchomić NGINX:

```
$ nginx -t && nginx -s reload
```

4. Generowanie centyfikatu w dowolnej lokalizacji automatycznie wpada do /etc/letsencrypt/live/
```
$ sudo certbot --nginx -d example.com -d www.example.com
```


```
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/example.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/example.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

```