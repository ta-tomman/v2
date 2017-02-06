[![Build Status](https://travis-ci.org/ta-tomman/v2.svg?branch=master)](https://travis-ci.org/ta-tomman/v2)

# TOMMAN

## 1 Install Ubuntu Server

## 2 Install Aplikasi Server

### 2.1 Install Apache

### 2.2 Install PHP7
via ondrej ppa

### 2.3 Install PostgreSQL

#### 2.3.1 Install PostgreSQL Server
via ppa

#### 2.3.2 Install PostGIS Extension


### 2.4 Install Redis
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

