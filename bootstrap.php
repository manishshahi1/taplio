<?php
// Include Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env file based on environment
use Dotenv\Dotenv;

try {
    $env = getenv('APP_ENV') ?: 'development'; // Default to development environment
    $dotenv = Dotenv::createImmutable(__DIR__ . '/', ".env.$env");
    $dotenv->load();

    // Other initialization code

} catch (\Throwable $e) {
    // Handle any errors or exceptions
    echo "Initialization failed: " . $e->getMessage();
    exit;
}
