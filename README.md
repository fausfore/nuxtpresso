## Getting Started
```bash
# Mount containers:
$ docker-compose up --build

# Install extra-configs
$ chmod +x install.sh && ./install.sh

# Build & start the front server:
$ npm i && npm run dev
```

### Browse to:
* `locahost:8000`: Configure WP Install after first build
* `locahost:8000/wp-admin`: WordPress Admin Dashboard
* `localhost:3333`: Nuxt frontend

### Settings:
* **Enable URL rewriting** for the WP REST API: 
  Go to `Settings/Permalinks`, select one of the rewritten options, and save.
* Enable Nuxtpress theme in `Appearance/Themes`
* Install required plugins in `Appearance/Install Plugins`





