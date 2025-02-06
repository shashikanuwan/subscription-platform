# Subscription App💥

## Installation 🛠️

1. **Clone the repository**
   ```bash
   git clone git@github.com:shashikanuwan/subscription-platform.git
   ```
   ```bash
   cd subscription-platform
   ```

2. **Install dependencies**
    ```bash
   composer i
   ```

3. **Set up your `.env` file**
   ```bash
   cp .env.example .env
   ```
   Update the database credentials and other configuration values.

4. **Generate the application key**
    ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders**
    ```bash
   php artisan migrate --seed
   ```

6. **Start the local development server**
    ```bash
   php artisan serve
   ```
