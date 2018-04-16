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
* `locahost:8000`: WordPress Admin Dashboard
* `localhost:3333`: Nuxt frontend

### Settings:
* **Enable URL rewriting** for the WP REST API: 
  Go to `Settings/Permalinks`, select one of the rewritten options, and save.
* Install required plugins in `Appearance/Install Plugins`
* Enable Nuxtpress theme in `Appearance/Themes`





