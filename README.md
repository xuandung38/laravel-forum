# laravel-forum

-   [Project Setup](#project-setup)
-   [Project Information](#project-information)

## Project setup

If you'd like to check this out locally, then follow the instructions below.

### Clone repository

First clone the repository, of course:

```bash
git clone git@github.com:sustained/laravel-forum.git
cd laravel-forum
```

### Initialise environment

Next you'll want to make a copy the example environment file:

```bash
cp .env.example .env
```

### Configure database

Now edit the `.env` file and configure the database.

If you're using **Postgres** with (IDENT authentication), like me, then all you'll need is this:

```dotenv
DB_CONNECTION=pgsql
DB_DATABASE=laravel_forum
```

### Create the database

Of course, you'll need to create the database as well as grant privileges:

```
[padda@aurora ~]$ psql postgres
postgres=> CREATE DATABASE laravel_forum;
CREATE DATABASE
postgres=> GRANT ALL PRIVILEGES ON DATABASE laravel_forum TO padda;
GRANT
```

If you don't have Postgres setup or are having issues, or you'd simply rather use SQlite then use this configuration instead:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/project/database/database.sqlite
```

And then create the database, again:

```bash
touch database/database.sqlite
```

### Run migrations

Now you can run the migrations:

```bash
php artisan migrate
```

### Good to go

Now you should be good to go - just run the development server:

```bash
php artisan serve --host=forum.localhost
```

---

## Project Information

### What is this?

This is me following along with the (paid) Laracasts series [Let's Build a Forum with Laravel and TDD](https://laracasts.com/series/lets-build-a-forum-with-laravel).

Consider it a part of my résumé.

### Why this series?

I've been learning PHP and Laravel lately (as well as relearning PostgreSQL, Redis, Vue etc.) and I think I finally feel confident enough to tackle a _real_ project.

Also, I'd like to learn more about Test Driven Development (don't have much experience with testing) so this series seemed perfect.

### How will this be different?

Instead of me just blindly copying the code each episode, instead I'll be trying to change things as much as possible to align with my own preferences.

For instance, I think I'll use this as an opportunity to learn Vuetify (whereas the tutorial I believe uses Bootstrap).

I'll probably try to implement my own ideas and add my own features too, in time.
