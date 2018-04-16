### lancez le container Wordpress
1 - Mounth containers

```bash
$ docker-compose up --build
```
2 - Install extra-configs

```bash
$ chmod +x install.sh && ./install.sh
```
Allez dans le locahost:8000, pour accéder au fichier d'install de wordpress.

### lancez le front

```bash
$ npm i && npm run dev
```



