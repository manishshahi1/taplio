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
include('../config/site_config.php');
$fullUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<head>
    <title><?= $title; ?> &mdash; <?= SITE_TITLE; ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?= $description; ?>" />
    <meta name="keywords" content="<?= $keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:url" content="<?= $fullUrl; ?>" />
    <meta property="og:site_name" content="<?= SITE_TITLE; ?>" />
    <link rel="canonical" href="<?= $fullUrl; ?>" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <?php foreach ($stylesheets as $stylesheet) : ?>
        <link rel="stylesheet" href="<?= (str_starts_with($stylesheet, 'http://') || str_starts_with($stylesheet, 'https://')) ? htmlspecialchars($stylesheet) : '../assets/css/pages/' . htmlspecialchars($stylesheet) . '.css?v=' . time(); ?>">
    <?php endforeach; ?>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php foreach ($gfonts as $gfont) : ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?= $gfont ?>&display=swap">
    <?php endforeach; ?> <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) 
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