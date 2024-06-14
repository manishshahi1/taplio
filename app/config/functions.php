<?php

// Include necessary files
include __DIR__ . '/../../bootstrap.php'; // Include bootstrap file
include 'site_config.php'; // Include site configuration file
include 'config.php'; // Include site configuration file
include __DIR__ . '/database/' . SITE_ENVIRONMENT . '/db.php'; // Include database configuration based on environment


use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;

// Import the necessary MongoDB classes
use MongoDB\Exception\Exception as MongoDBException;

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/**
 * Generates the HTML head section with provided parameters.
 *
 * @param string $title The title of the page.
 * @param array $metatags An array of meta tags in name => content format.
 * @param array $stylesheets An array of stylesheet URLs.
 * @param array $gfonts An array of Google Font families to include.
 * @param string $inline_js Inline JavaScript code.
 * @return void
 */
function generate_head_tags(string $title, array $metatags = [], array $stylesheets = [], array $gfonts = [], string $inline_js = ''): void
{
    ob_start(); ?>
    <!DOCTYPE html>
    <!--
        Author: Keenthemes
        Product Name: MetronicProduct Version: 8.2.5
        Purchase: https://1.envato.market/EA4JP
        Website: http://www.keenthemes.com
        Contact: support@keenthemes.com
        Follow: www.twitter.com/keenthemes
        Dribbble: www.dribbble.com/keenthemes
        Like: www.facebook.com/keenthemes
        License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
    -->
    <html lang="en">
    <!--begin::Head-->

    <?php
    // include('../config/site_config.php');
    $fullUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>

    <head>
        <title><?= $title; ?> &mdash; <?= SITE_TITLE; ?></title>
        <meta charset="utf-8" />
        <?php foreach ($metatags as $name => $content) : ?>
            <meta name="<?= htmlspecialchars($name) ?>" content="<?= htmlspecialchars($content) ?>">
        <?php endforeach; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Open Graph / Facebook -->
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?= $title; ?>" />
        <meta property="og:url" content="<?= $fullUrl; ?>" />
        <meta property="og:site_name" content="<?= SITE_TITLE; ?>" />
        <!-- twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="<?= $fullUrl; ?>" />
        <?php if (isset($metatags['description'])) : ?>
            <meta name="twitter:description" content="<?= htmlspecialchars($metatags['description']) ?>">
        <?php endif; ?>
        <meta property="twitter:title" content="<?= $title; ?>" />
        <meta property="twitter:image" content="assets/images/twitter.png" />
        <!-- ./twitter -->
        <link rel="canonical" href="<?= $fullUrl; ?>" />
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
        <?php foreach ($stylesheets as $stylesheet) : ?>
            <link rel="stylesheet" href="<?= (str_starts_with($stylesheet, 'http://') || str_starts_with($stylesheet, 'https://')) ? htmlspecialchars($stylesheet) : 'assets/css/pages/' . htmlspecialchars($stylesheet) . '.css?v=' . time(); ?>">
        <?php endforeach; ?>
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://cdnjs.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php foreach ($gfonts as $gfont) : ?>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=<?= $gfont ?>&display=swap">
        <?php endforeach; ?> <!--end::Fonts-->
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <script>
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
        <?php if ($inline_js) : ?>
            <script>
                <?= $inline_js; ?>
            </script>
        <?php endif; ?>
    </head>

    <body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-sidebar-stacked="true" data-kt-app-sidebar-secondary-enabled="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>

    <?= minify_html(ob_get_clean());
}
// END HTML
/**
 * Ends the HTML document by including JavaScript files and closing HTML tags.
 *
 * @param array $js An array of JavaScript file URLs.
 * @param bool $is_jquery Option to load jQuery from CDN with local fallback.
 * @param bool $is_bootstrap_js Option to load Bootstrap JS from CDN with local fallback.
 * @param mixed $footer_inline_js Inline JavaScript code for the footer. Optional.
 * @return void
 */
function end_html(array $js = [], bool $is_jquery = false, bool $is_bootstrap_js = false, $footer_inline_js = null): void
{
    ob_start();

    ?>

        <script>
            var hostUrl = "assets/";
        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <?php

        // Load jQuery from CDN with local fallback, if not already loaded
        if ($is_jquery) {
            echo '<script>
                if (typeof jQuery === "undefined") {
                    document.write(\'<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><\/script>\');
                    document.write(\'<script>window.jQuery || document.write("<script src="assets/js/jquery.min.js"><\/script>")<\/script>\');
                }
              </script>' . PHP_EOL;
        }

        // Load Bootstrap JS from CDN with local fallback
        if ($is_bootstrap_js) {
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>' . PHP_EOL;
            echo '<script>typeof($.fn.modal) === "undefined" && document.write(\'<script src="assets/js/bootstrap.bundle.min.js"><\/script>\')</script>' . PHP_EOL;
        }

        // Load additional JS files
        foreach ($js as $js_file) {
            $src = (str_starts_with($js_file, 'http://') || str_starts_with($js_file, 'https://'))
                ? htmlspecialchars($js_file)
                : 'assets/js/pages/' . htmlspecialchars($js_file) . '.js?v=' . time();
            echo '<script src="' . $src . '"></script>' . PHP_EOL;
        }
        ?>
        <!-- Script to remove end slash from URL -->
        <script>
            /* window.onload = function() {
                if (!isRootDirectory()) {
                    redirectToNonSlashVersion();
                }
            };

            function isRootDirectory() {
                let currentURL = window.location.href;
                return currentURL.length === 1 && currentURL.charAt(currentURL.length - 1) === '/';
            }

            function redirectToNonSlashVersion() {
                let currentURL = window.location.href;
                if (currentURL.substr(-1) === '/') {
                    let nonSlashURL = currentURL.substr(0, currentURL.length - 1);
                    window.location.replace(nonSlashURL);
                }
            }*/
        </script>
        <?php
        // Inline JavaScript code for the footer
        if ($footer_inline_js !== null) : ?>
            <script>
                <?= $footer_inline_js; ?>
            </script>
    <?php endif;

        echo minify_html(ob_get_clean());
        echo "</body></html>";
    }
    ?>
    <?php
    /**
     * Minifies HTML code by removing unnecessary whitespace and comments.
     *
     * @param string $html The HTML code to minify.
     * @return string The minified HTML code.
     */
    function minify_html(string $html): string
    {
        return preg_replace(['/<!--(.|\s)*?-->/', '/\s+/', '/\s+<([^\/\s]+)\s+/', '/\s+<\/([^\/\s]+)>/', '/^\s+/m'], ['', ' ', '<$1 ', '</$1>', ''], $html);
    }
    /**
     * MONGODB
     */


    /**
     * Selects the MongoDB database.
     *
     * @param Client $client The MongoDB client.
     * @return Database The selected database.
     */
    function selectDatabase(Client $client): Database
    {
        return $client->selectDatabase($_ENV['MONGODB_DATABASE']);
    }

    /**
     * Selects the MongoDB collection.
     *
     * @param Database $db The MongoDB database.
     * @param string $collectionName The name of the collection.
     * @return Collection The selected collection.
     */
    function selectCollection(Database $db, string $collectionName): Collection
    {
        return $db->selectCollection($collectionName);
    }

    /**
     * Inserts one document into the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $document The document to insert.
     * @return void
     */
    function insertOneDocument(Collection $collection, array $document): void
    {
        $collection->insertOne($document);
    }

    /**
     * Inserts many documents into the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $documents The documents to insert.
     * @return void
     */
    function insertManyDocuments(Collection $collection, array $documents): void
    {
        $collection->insertMany($documents);
    }

    /**
     * Reads one document from the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $filter The filter criteria.
     * @return array|null The found document or null if none found.
     */
    function readOneDocument(Collection $collection, array $filter = []): ?array
    {
        return $collection->findOne($filter);
    }

    /**
     * Reads many documents from the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $filter The filter criteria.
     * @return iterable The found documents.
     */
    function readManyDocuments(Collection $collection, array $filter = []): iterable
    {
        return $collection->find($filter);
    }

    /**
     * Updates (replaces) one document in the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $filter The filter criteria.
     * @param array $update The update document.
     * @return void
     */
    function updateOneDocument(Collection $collection, array $filter, array $update): void
    {
        $collection->replaceOne($filter, $update);
    }

    /**
     * Deletes documents from the MongoDB collection.
     *
     * @param Collection $collection The MongoDB collection.
     * @param array $filter The filter criteria.
     * @return void
     */
    function deleteDocuments(Collection $collection, array $filter): void
    {
        $collection->deleteMany($filter);
    }

    /**
     * UTILITIS
     */
    function curDate()
    {
        return date('m/d/Y h:i:s a', time());
    }
    // Load third-party plugin
    function loadPlugin($folderName)
    {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
        $baseDir = 'app/assets/third_party/';
        $dirPath = $baseDir . $folderName;

        if (is_dir($dirPath)) {
            foreach (glob("$dirPath/*.{css,js}", GLOB_BRACE) as $file) {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $publicPath = str_replace('app/', '', $file); // Remove 'app/' from the path
                if ($ext === 'css') {
                    echo '<link rel="stylesheet" href="' . $publicPath . '">' . PHP_EOL;
                } elseif ($ext === 'js') {
                    echo '<script src="' . $publicPath . '"></script>' . PHP_EOL;
                }
            }
        } else {
            echo "Directory not found.";
        }
    }

    // Generate UserID
    function generateUserID($length = 8): string
    {
        return substr(base64_encode(random_bytes($length)), 0, $length);
    }

    // Generate Verification Code
    function generateVerificationCode($length = 6): string
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }

    /** PHP MAILER */
    function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output || Set to 0 in production
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host       = 'mail.smtp2go.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'codersgram.in'; // SMTP username
            $mail->Password   = 'hello123@'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 2525; // TCP port to connect to

            //Recipients
            $mail->setFrom('manish@codersgram.in', 'Manish Shahi'); // Set sender address and name (needs to be different that $email->Username)
            $mail->addAddress($to); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    /** END */

    /**
     * APIs
     */



    // Securely get encryption key from environment variable
    $encryption_key = $_ENV['ENCRYPTION_KEY'];
    if (!$encryption_key) {
        die(json_encode(["status" => 500, "error" => true, "message" => "Encryption key not set in environment variable"], JSON_UNESCAPED_SLASHES));
    }


    // Function to handle user signup
    function user_signup($formData)
    {
        global $encryption_key;

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // If not, return error response
            return json_encode(["status" => 400, "error" => true, "message" => "Bad Request. Only POST method allowed."], JSON_UNESCAPED_SLASHES);
        }


        // Connect to MongoDB
        $client = connectMongoDB();
        $db = selectDatabase($client);

        // Select MongoDB collection
        $collection = selectCollection($db, 'users');

        // Check if email or username already exists
        $existingUser = $collection->findOne(
            ['$or' => [
                ['email' => $formData['email_address']],
                ['username' => $formData['username']]
            ]]
        );

        // Send activation email to the user
        $to = $formData['email_address'];
        $subject = 'Verify your email address';
        $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Email Verification</title>
            </head>
            <body>
                <p>Hello, thanks for signing up. <a href="http://localhost/inf/verify?u=' . generateUserID() . '&v=' . generateVerificationCode(6) . '">Click here</a> to verify your email address.</p>
            </body>
            </html>
        ';
        $response = [];

        if (isValidEmail($to)) {
            if (sendEmail($to, $subject, $message)) {
                $response['status'] = '200';
                $response['message'] = "Email sent successfully to $to.";
            } else {
                $response['status'] = '400';
                $response['message'] = "Failed to send email to $to.";
            }
        } else {
            $response['status'] = '400';
            $response['message'] = "Invalid email address: $to.";
        }

        header('Content-Type: application/json');
        echo json_encode($response);


        // Encrypt the email address
        $encryptedEmail = encrypt(
            $formData['email_address'],
            $encryption_key
        );

        $formData['email_address'] = $encryptedEmail;

        if ($existingUser) {
            // If email or username already exists, return error response
            return json_encode(["status" => 400, "error" => true, "message" => "Email or username already exists."], JSON_UNESCAPED_SLASHES);
        }

        // Hash the password
        $hashedPassword = password_hash($formData['password'], PASSWORD_BCRYPT, array("cost" => 10));

        // Replace the plain password with the hashed password in the form data
        $formData['password'] = $hashedPassword;

        // Add created_at and updated_at fields
        $formData['created_at'] = curDate();
        $formData['updated_at'] = null; // No date initially

        // Log current IP address
        $formData['ip_address'] = $_SERVER['REMOTE_ADDR'];

        // Insert form data into MongoDB collection
        try {
            insertOneDocument($collection, $formData);
            // Return JSON-encoded success message with status 200
            return json_encode(["status" => 200, "success" => true, "message" => "User signed up successfully."], JSON_UNESCAPED_SLASHES);
        } catch (MongoDBException $e) {
            // Return JSON-encoded error message with status 500
            return json_encode(["status" => 500, "error" => true, "message" => "An unexpected error occurred."], JSON_UNESCAPED_SLASHES);
        }
    }

    // function to handle user login
    function user_login($formData)
    {
        global $encryption_key;

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // If not, return error response
            return json_encode(["status" => 400, "error" => true, "message" => "Bad Request. Only POST method allowed."], JSON_UNESCAPED_SLASHES);
        }

        // Connect to MongoDB
        $client = connectMongoDB();
        $db = selectDatabase($client);

        // Select MongoDB collection
        $collection = selectCollection($db, 'users');

        $userName = $formData['email_address'];
        $decryptedEmail = decrypt($formData['email_address'], $encryption_key);

        // Find user by email address or username
        $user = $collection->findOne([
            '$or' => [
                ['email' => $decryptedEmail],
                ['username' => $userName]
            ]
        ]);

        // Check if user exists
        if ($user) {
            // Verify password
            if (password_verify($formData['password'], $user['password'])) {
                // Password is correct
                // Start session
                session_start();
                // Set session variable
                $_SESSION['user_id'] = $user['_id'];
                // You can return user data here if needed
                return json_encode(["status" => 200, "success" => true, "message" => "Login successful. Redirecting..."], JSON_UNESCAPED_SLASHES);
            } else {
                // Password is incorrect
                return json_encode(["status" => 400, "error" => true, "message" => "Incorrect username or password."], JSON_UNESCAPED_SLASHES);
            }
        } else {
            // User not found
            return json_encode(["status" => 400, "error" => true, "message" => "User does not exist."], JSON_UNESCAPED_SLASHES);
        }
    }
    // Function to handle forgot password request
    function forgot_password($email)
    {
        // Validate email address (you may want to use a more robust validation method)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(["status" => 400, "error" => true, "message" => "Invalid email address."]);
        }

        // Connect to MongoDB
        $client = connectMongoDB();
        $db = selectDatabase($client);
        $collection = selectCollection($db, 'users');

        // Check if the email exists in the database
        $user = $collection->findOne(['email' => $email]);

        if (!$user) {
            // If email does not exist in the database
            return json_encode(["status" => 400, "error" => true, "message" => "Email address not found."]);
        }

        // Generate a unique token (you can use any method you prefer, like random_bytes() or a library)
        $token = bin2hex(random_bytes(32));

        // Set expiration time (e.g., 1 hour from now)
        $expiration = time() + 3600;

        // Store the token and expiration time in the database
        $collection->updateOne(
            ['email' => $email],
            ['$set' => ['reset_token' => $token, 'reset_token_expiration' => $expiration]]
        );

        // Compose email message
        $resetLink = "https://example.com/reset-password?token=$token"; // Change example.com to your domain
        $message = "Dear user,\n\nTo reset your password, please click on the following link: $resetLink";

        // Send email
        $subject = "Password Reset Request";
        $headers = "From: Your Website <noreply@example.com>\r\n";
        $headers .= "Reply-To: noreply@example.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        mail($email, $subject, $message, $headers);

        return json_encode(["status" => 200, "success" => true, "message" => "Password reset instructions sent to your email."]);
    }

    // Function to handle like of a post
    function saveLike($formData)
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // If not, return error response
            return json_encode(["status" => 400, "error" => true, "message" => "Bad Request. Only POST method allowed."], JSON_UNESCAPED_SLASHES);
        }

        // Validate input data
        if (empty($formData['post_id']) || empty($formData['user_id'])) {
            return json_encode(["status" => 400, "error" => true, "message" => "Post ID and User ID are required."], JSON_UNESCAPED_SLASHES);
        }

        // Connect to MongoDB
        $client = connectMongoDB();
        $db = selectDatabase($client);

        // Select MongoDB collection
        $collection = selectCollection($db, 'likes');

        // Check if the like already exists
        $existingLike = $collection->findOne([
            'post_id' => $formData['post_id'],
            'user_id' => $formData['user_id'],
        ]);

        if ($existingLike) {
            return json_encode(["status" => 409, "error" => true, "message" => "This post is already liked by the user."], JSON_UNESCAPED_SLASHES);
        }

        // Create the like document
        $likeDocument = [
            'post_id' => $formData['post_id'],
            'user_id' => $formData['user_id'],
            'liked_at' => curDate()
        ];

        // Insert the like document into the collection
        try {
            insertOneDocument($collection, $likeDocument);
            // Return JSON-encoded success message with status 200
            return json_encode(["status" => 200, "success" => true, "message" => "Like saved successfully."], JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            // Return JSON-encoded error message with status 500
            return json_encode(["status" => 500, "error" => true, "message" => "An unexpected error occurred."], JSON_UNESCAPED_SLASHES);
        }
    }


    // Function to handle posting a comment
    function postComment($formData)
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // If not, return error response
            return json_encode(["status" => 400, "error" => true, "message" => "Bad Request. Only POST method allowed."], JSON_UNESCAPED_SLASHES);
        }

        // Validate input data
        if (empty($formData['post_id']) || empty($formData['user_id'])) {
            return json_encode(["status" => 400, "error" => true, "message" => "Post ID and User ID are required."], JSON_UNESCAPED_SLASHES);
        }

        // Connect to MongoDB
        $client = connectMongoDB();
        $db = selectDatabase($client);

        // Select MongoDB collection
        $collection = selectCollection($db, 'comments');

        $hasImage = false;

        // Create the comments document
        $likeDocument = [
            'post_id' => $formData['post_id'],
            'user_id' => $formData['user_id'],
            'content' => $formData['comment'],
            'created_at' => curDate()
        ];

        if ($hasImage == true) {
            $likeDocument['image_path'] = $formData['image_path'];
        }

        // Insert the like document into the collection
        try {
            insertOneDocument($collection, $likeDocument);
            // Return JSON-encoded success message with status 200
            return json_encode(["status" => 200, "success" => true, "message" => "Comment posted successfully."], JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            // Return JSON-encoded error message with status 500
            return json_encode(["status" => 500, "error" => true, "message" => "An unexpected error occurred."], JSON_UNESCAPED_SLASHES);
        }
    }


    /*
    * ENCRYPTION & DECRYPTION
    */

    /**
     * Encrypts the given data using AES-256-CBC with a salted key derived from the provided key.
     *
     * @param string $data The data to encrypt.
     * @param string $key The encryption key.
     * @return string The base64 encoded string containing the salt, IV, and encrypted data.
     */
    function encrypt($data, $key)
    {
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_length); // Generate IV
        $salt = openssl_random_pseudo_bytes(16); // Generate 16 bytes salt
        $iterations = 100000; // Increased iterations for PBKDF2
        $salted_key = hash_pbkdf2('sha256', $key, $salt, $iterations, 32, true); // Generate salted key
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $salted_key, 0, $iv); // Encrypt the data
        // Concatenate salt, IV, and encrypted data
        return base64_encode($salt . $iv . $encrypted);
    }

    /**
     * Decrypts the given data using AES-256-CBC with a salted key derived from the provided key.
     *
     * @param string $data The base64 encoded string containing the salt, IV, and encrypted data.
     * @param string $key The decryption key.
     * @return string The decrypted data.
     */
    function decrypt($data, $key)
    {
        $data = base64_decode($data); // Decode base64 string
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $salt_length = 16; // Salt length
        // Extract salt
        $salt = substr($data, 0, $salt_length);
        // Extract IV
        $iv = substr($data, $salt_length, $iv_length);
        // Extract encrypted data
        $encrypted = substr($data, $salt_length + $iv_length);
        $iterations = 100000; // Use the same number of iterations as in the encryption process
        // Generate salted key using the same salt
        $salted_key = hash_pbkdf2('sha256', $key, $salt, $iterations, 32, true);
        // Decrypt the data
        return openssl_decrypt($encrypted, 'aes-256-cbc', $salted_key, 0, $iv);
    }
    /**
     * Retrieves session data for the logged-in user.
     * If the session variable 'email_address' is set, it returns the email address.
     * Otherwise, it redirects the user to the login page.
     *
     * @return string JSON-encoded session data (email address) if available.
     *               Otherwise, redirects the user to the login page.
     */
    function getSessionData()
    {
        session_start();
        // Check if the session variable is set
        if (isset($_SESSION['user_id'])) {
            // Return the session data
            return json_encode($_SESSION['user_id']);
        } else {

            header("Location: login");
            exit; // Make sure to stop execution after the redirect
        }
    }
    /**
     * Redirects the user to a different page if already logged in.
     */
    function redirectToDashboardIfLoggedIn()
    {
        session_start();
        // Check if the session variable is set
        if (isset($_SESSION['user_id'])) {
            // User is already logged in, redirect to dashboard or home page
            header("Location: home"); // Change 'dashboard.php' to the appropriate page
            exit; // Make sure to stop execution after the redirect
        }
    }



    /**
     * Logs out the user by destroying the session.
     * Redirects the user to the login page after logout.
     */
    function logout()
    {
        session_start();
        // Unset all session variables
        $_SESSION = array();
        // Destroy the session
        session_destroy();
        // Redirect to the login page
        header("Location: login");
        exit; // Make sure to stop execution after the redirect
    }
