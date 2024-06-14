<?php
date_default_timezone_set("Asia/Kolkata");

// Determine the protocol (HTTP or HTTPS)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Determine the base URL
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';

// Determine environment settings based on domain
switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
        $config_folder = "development";
        break;
    case 'storemagic.me':
    default:
        $config_folder = "production";
        if (!isset($isRouter) && $_SERVER['HTTP_HOST'] !== 'storemagic.me') {
            header("Location: $base_url");
            exit;
        }
        break;
}

// URLs and Paths
$customer_portal_url = $base_url;
$admin_portal_url = $base_url . "inf_admin/";
$pathForApp = "/var/www/storemagic.me/app";
$pathForStoreRootDIR = "$pathForApp/store_root";

// Other configurations
$site_title = " LinkFusion";
$dns_CNAME_Record_Check_URL = "storemagic.me";
$emailForSSL = "admin@storemagic.me";
$serverIPv4 = "143.110.184.201";
$TOKEN_findipNet = "4677067cbf144ff89491685b5adec53c";

// Define constants
define('DNS_CNAME_Record_Check_URL', $dns_CNAME_Record_Check_URL);
define('HOME_URL', $base_url);
define('SERVER_IPV4', $serverIPv4);
define('CUSTOMER_PORTAL_URL', $customer_portal_url);
define('ADMIN_PORTAL_URL', $admin_portal_url);
define('SITE_TITLE', $site_title);
define('CONFIG_FOLDER', $config_folder);
define('PATH_FOR_APP', $pathForApp);
define('PATH_FOR_STORE_ROOT_DIR', $pathForStoreRootDIR);
define('EMAIL_FOR_SSL', $emailForSSL);
define('TOKEN_findipNet', $TOKEN_findipNet);
