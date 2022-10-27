
# Issue Ticket Open System

Ticketing system for a record history of feedback lists or bugs from client.

## Authors

- [@kg-myat-tun](https://github.com/kg-myat-tun)


## Features

- user open ticket
- Issue type
- Developer assignment
- Status update


## Installation

Clone the repository

```bash
  git clone https://github.com/kg-myat-tun/issue-ticket-system.git
```

Install all the dependencies using composer

```bash
  composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
  cp .env.example .env
```
Generate a new application key

```bash
  php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating)

```bash
  php artisan migrate
```

Database seeding

```bash
  php artisan db:seed
```

Start the local development server

```bash
  php artisan serve
```


    