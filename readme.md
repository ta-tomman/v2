# TOMMAN

## Install Ubuntu Server

## Install Aplikasi Server

### Install Apache

### Install PHP7
via ondrej ppa

### Install PostgreSQL

#### Install PostgreSQL DB Server
via ppa

#### Install PostGIS Extension


### Install Redis
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

configuration
file `/etc/redis/redis.conf`
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

