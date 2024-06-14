<?php
require __DIR__ . '/../../../../bootstrap.php';

// Function to establish MongoDB connection
function connectMongoDB()
{
    // Load MongoDB URI from environment variables
    $mongoUri = $_ENV['MONGODB_URI'];

    // Create MongoDB client using the provided URI
    return new MongoDB\Client($mongoUri);
}
