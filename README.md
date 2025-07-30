# Laravel Ecommerce Store

A complete ecommerce solution built with Laravel, featuring a modern frontend, comprehensive admin dashboard, payment processing, and deployment configuration.

## Features

### Frontend
- Modern, responsive design with Tailwind CSS
- Product catalog with search and filtering
- Shopping cart functionality
- User authentication and registration
- Order management
- Checkout process with Stripe integration

### Admin Dashboard
- Product management (CRUD operations)
- Order management and status updates
- User management
- Sales analytics and reporting
- Inventory tracking

### Technical Features
- Laravel 10 with PHP 8.2
- MySQL database with proper relationships
- Stripe payment integration
- Image upload and management
- Email notifications
- Comprehensive testing suite
- Docker containerization
- CI/CD pipeline with GitHub Actions

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL 8.0
- Git

### Local Development Setup

1. **Clone the repository**
   \`\`\`bash
   git clone https://github.com/yourusername/laravel-ecommerce.git
   cd laravel-ecommerce
   \`\`\`

2. **Install PHP dependencies**
   \`\`\`bash
   composer install
   \`\`\`

3. **Install Node.js dependencies**
   \`\`\`bash
   npm install
   \`\`\`

4. **Environment setup**
   \`\`\`bash
   cp .env.example .env
   php artisan key:generate
   \`\`\`

5. **Configure database**
   - Create a MySQL database named `ecommerce_store`
   - Update `.env` file with your database credentials:
   \`\`\`env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ecommerce_store
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   \`\`\`

6. **Configure Stripe**
   - Get your Stripe API keys from [Stripe Dashboard](https://dashboard.stripe.com/apikeys)
   - Add to `.env` file:
   \`\`\`env
   STRIPE_KEY=pk_test_your_publishable_key
   STRIPE_SECRET=sk_test_your_secret_key
   \`\`\`

7. **Run migrations and seed data**
   \`\`\`bash
   php artisan migrate --seed
   \`\`\`

8. **Build assets**
   \`\`\`bash
   npm run build
   \`\`\`

9. **Start the development server**
   \`\`\`bash
   php artisan serve
   \`\`\`

The application will be available at `http://localhost:8000`

### Docker Setup

1. **Build and start containers**
   \`\`\`bash
   docker-compose up -d --build
   \`\`\`

2. **Install dependencies inside container**
   \`\`\`bash
   docker-compose exec app composer install
   docker-compose exec app npm install && npm run build
   \`\`\`

3. **Run migrations**
   \`\`\`bash
   docker-compose exec app php artisan migrate --seed
   \`\`\`

The application will be available at `http://localhost:8000`

## Default Users

After running the seeders, you can login with:

**Admin User:**
- Email: admin@example.com
- Password: password

**Regular User:**
- Email: test@example.com
- Password: password

## Testing

Run the test suite:
\`\`\`bash
php artisan test
\`\`\`

Or with PHPUnit directly:
\`\`\`bash
vendor/bin/phpunit
\`\`\`

## Deployment

### Production Server Setup

1. **Server Requirements**
   - Ubuntu 20.04 LTS or similar
   - PHP 8.2 with required extensions
   - Nginx or Apache
   - MySQL 8.0
   - Composer
   - Node.js and NPM

2. **Deploy using the script**
   \`\`\`bash
   chmod +x deploy.sh
   ./deploy.sh
   \`\`\`

3. **Configure web server**
   - Point document root to `/public` directory
   - Configure SSL certificate
   - Set up proper file permissions

### Environment Variables

Key environment variables for production:

\`\`\`env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

STRIPE_KEY=pk_live_your_live_publishable_key
STRIPE_SECRET=sk_live_your_live_secret_key

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_email_password
\`\`\`

## API Documentation

The application includes RESTful API endpoints for:

- Products: `/api/products`
- Categories: `/api/categories`
- Orders: `/api/orders` (authenticated)
- Cart: `/api/cart` (authenticated)

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Security

If you discover any security-related issues, please email security@yourdomain.com instead of using the issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, email support@yourdomain.com or join our Slack channel.

## Roadmap

- [ ] Multi-vendor marketplace functionality
- [ ] Advanced inventory management
- [ ] Wishlist functionality
- [ ] Product reviews and ratings
- [ ] Advanced analytics dashboard
- [ ] Mobile app API
- [ ] Multi-language support
- [ ] Advanced SEO features
