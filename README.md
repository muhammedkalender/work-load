## Projeyi başlatma

### Docker

> MySQL Portu : 3306 <br>
> Nginx Portu : 8080 <br>
> Eğer portları değiştirmek isterseniz lütfen konfigürasyonuda güncelleyin

-------

```bash
docker-compose build --no-cache
```

```bash
docker-compose up -d
```

#### DB Migration

```bash
docker exec -it wl-php-container /bin/sh -c "php bin/console doctrine:migrations:migrate"
```

Veya

```bash
docker exec -it $CONTAINER_ID /bin/sh -c "php bin/console doctrine:migrations:migrate"
```

#### Fetch Tasks

```bash
docker exec -it wl-php-container /bin/sh -c "php bin/console app:fetch-tasks"
```

Veya


```bash
docker exec -it $CONTAINER_ID /bin/sh -c "php bin/console app:fetch-tasks"
```

<a href="http://localhost:8080/">Giriş Sayfası</a>

### Native

> PHP : 7.4<br>
> MySQL Extension Gereklidir<br>
> Çalıştırmadan önce DB Bilgilerini güncelleyin
```bash
composer install
```

Ardından

>Nginx yada internal server konfigürasyonlarınıza göre websitesini açın

Migration İçin

```bash
php bin/console app:fetch-tasks
```

Task listesini çekmek İçin

```bash
php bin/console app:fetch-tasks
```