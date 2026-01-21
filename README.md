# easy_web

A lightweight Laravel-based web application for managing website content direct by the user from backend.
just like content management system

# Author

- Isuru Sanjana (https://www.linkedin.com/in/isurusanjana)

## Requirements

- PHP 8.1+ with CLI
- Composer
- Laravel 12
- Node.js (16+) and npm or yarn
- MySQL

## Quick Setup

1. Clone the repo

   git clone https://github.com/isurusanjana/easy_web.git
   cd easy_web

2. Install PHP dependencies

   composer install

3. Environment

   cp .env.example .env
   Edit `.env` to set your database and mail configuration.

4. Generate app key

   php artisan key:generate

5. Run migrations and seeders

   php artisan migrate --seed

6. Install frontend dependencies and build assets

   npm install
   npm run dev

7. Serve the app locally

   php artisan serve

## Running Tests

- Run feature & unit tests:

  ./vendor/bin/pest

or

  php artisan test

## Project Notes

- This project uses Vite for asset bundling and Pest for tests.
- See `routes`, `app/Models`, and `resources/views` for primary application structure.

## Contributing

- Fork, create a feature branch, add tests, and open a pull request.

## License

MIT — see the LICENSE file if present.
