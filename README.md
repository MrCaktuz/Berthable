# Berthable

> Berthable is a self-funded project aimed at creating a blog for storing our personal cooking recipes and creations. Initially designed for personal use with minimal features, the project is built with the flexibility to evolve over time. Features will be added gradually based on our needs and how we use the platform.

## Local setup

This project uses the [Bedrock](https://roots.io/bedrock/) WordPress boilerplate as its foundation and is configured with Docker for seamless local development across any environment.

### First setup

run

```
composer install
```

Create a `.env` file with your personal data and make sure to use the same structure as the `.env.example` file.

Add the domain name `berthable.test` to you local `hosts` file t be able to use HTTPS during developpement, otherwise use localhost.

### How to use

#### Start containers

```
docker compose up -d --build
```

#### Stop containers

```
docker compose down
```

#### Use wp-cli

```
docker compose run --rm wp [COMMAND]
```

#### Work on the theme styles

Do an install of npm packages

```
npm install
```

After that you can watch styles with this

```
npm run style:watch
```

## Next changes

- Make titles not bold anymore.
- Send an email to be notified when an author published a new recipe.