[![Build Status](https://travis-ci.org/ta-tomman/v2.svg?branch=master)](https://travis-ci.org/ta-tomman/v2)

# TOMMAN

## 1 Install Ubuntu Server

## 2 Install Aplikasi Server

### 2.1 Apache

### 2.2 PHP7
via ondrej ppa

### 2.3 PostgreSQL

#### 2.3.1 Install PostgreSQL Server
via ppa

#### 2.3.2 Install PostGIS Extension

#### 2.3.3 Create DB User

#### 2.3.4 Create DB
create db, assign user, install postgis


### 2.4 Redis

#### 2.4.1 Install Redis Server
via chris-lea ppa

```
sudo add-apt-repository ppa:chris-lea/redis-server
sudo apt update
sudo apt install redis-server
```

data directory
```
sudo mkdir -p /srv/redis
sudo chown redis:redis /srv/redis
```

file konfigurasi `/etc/redis/redis.conf`
sesuaikan dengan alokasi RAM

```
dir /srv/redis
save ""
maxmemory 16gb
maxmemory-policy allkeys-lru
```

untuk lebih pasti, _comment-out_ semua `save` directive di file config

restart redis
```
sudo service redis-server restart
```

#### 2.4.2 Install PHPRedis Extension
Install via PEAR
````
sudo pecl install redis
````

Buat file `/etc/php/7.0/mods-available/redis.ini`
````
extension=redis.so
````

Aktifkan _extension_
````
sudo phpenmod redis
````

Restart **apache**
````
sudo service restart apache2
````

