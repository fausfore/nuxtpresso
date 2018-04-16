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

# Build & start the front server:
$ npm i && npm run dev
```

### Browse to:
* `locahost:8000`: WordPress Admin Dashboard
* `localhost:3333`: Nuxt frontend

### Settings:
* **Enable URL rewriting** for the WP REST API: 
  Go to `Settings/Permalinks`, select one of the rewritten options, and save.
* Install required plugins in `Appearance/Install Plugins`
* Enable Nuxtpress theme in `Appearance/Themes`





