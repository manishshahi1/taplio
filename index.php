<?php
// Function to serve the requested file
function serveFile($path)
{
    // Prevent directory traversal attacks
    $fileName = basename($path);

    // Construct the full file path within the 'app' directory
    $phpFilePath = __DIR__ . '/app/' . $fileName . '.php';
    $cssFilePath = __DIR__ . '/app/assets/css/' . $fileName . '.css';
    $jsFilePath = __DIR__ . '/app/assets/js/' . $fileName . '.js';

    // Check if the file exists and ensure it's within the 'app' directory
    if (isFileWithinDirectory($phpFilePath, __DIR__ . '/app')) {
        require $phpFilePath; // Require the requested PHP file
    } elseif (file_exists($cssFilePath)) {
        // Serve CSS files directly
        serveStaticFile($cssFilePath, 'text/css');
    } elseif (file_exists($jsFilePath)) {
        // Serve JavaScript files directly
        serveStaticFile($jsFilePath, 'application/javascript');
    } else {
        serve404Error(); // Serve 404 error
    }
}

// Function to check if a file is within a directory
function isFileWithinDirectory($filePath, $directory)
{
    return file_exists($filePath) && str_starts_with(realpath($filePath), realpath($directory));
}

// Function to serve static files directly
function serveStaticFile($filePath, $mimeType)
{
    // Set the appropriate headers
    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . filesize($filePath));

    // Output the file content
    readfile($filePath);
    exit; // Terminate script execution
}

// Function to serve 404 error
function serve404Error()
{
    http_response_code(404); // Set HTTP response code to 404
    echo 'Oops! 404 Not Found.'; // Display a 404 error message
}

// Get the requested path, default to 'home' if not set
$path = $_GET['path'] ?? 'home';

// Serve the requested file
serveFile($path);
