<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | register</title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/AdminAuth-Deu25Omq.css"/>
    <script type="module" src="./assets/js/hoisted-C_1GnFOu.js"></script>
</head>
<body>
<?php
include "layout/inc/header.php";
?>
<main class="relative Main">
    <div class="imgContainer absolute"><img src="./assets/images/asre-cnAquRBy_ZfACzo.webp" alt="bg" class="img-cover"
                                            loading="eager" width="1200" height="800" decoding="async"></div>
    <div class="container d-flex items-start justify-center mt-14 AuthMain">
        <section class="slideAuth relative mx-auto">
            <div class="d-flex items-start overflow-hidden" id="container">
                <section class="ChooseAuth d-flex items-center justify-center"> <!-- box for admin -->
                    <div class="Box ml-14 relative text-center round-6">
                        <svg width="1em" height="1em" viewBox="0 0 36 36" data-icon="admin">
                            <symbol id="ai:local:admin">
                                <path fill="currentColor"
                                      d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75 6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76 4.76 4.76 0 0 0-4.76-4.76"
                                      class="clr-i-outline clr-i-outline-path-1"/>
                                <path fill="currentColor"
                                      d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.81 14.81 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z"
                                      class="clr-i-outline clr-i-outline-path-2"/>
                                <path fill="currentColor" d="M26.87 16.29a.37.37 0 0 1 .15 0 .42.42 0 0 0-.15 0"
                                      class="clr-i-outline clr-i-outline-path-3"/>
                                <path fill="currentColor"
                                      d="m33.68 23.32-2-.61a7.21 7.21 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7.15 7.15 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.77 6.77 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7.09 7.09 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a6.92 6.92 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28"
                                      class="clr-i-outline clr-i-outline-path-4"/>
                                <path fill="none" d="M0 0h36v36H0z"/>
                            </symbol>
                            <use xlink:href="#ai:local:admin"></use>
                        </svg>
                        <p class="fw-500 fs-18 pt-5">تسجيل كمشرف</p> <a href="AdminAuth.php" title="AdminAuth.php"
                                                                        class="absolute"></a></div>
                    <div class="Box relative text-center round-6">
                        <svg width="1em" height="1em" viewBox="0 0 36 36" data-icon="client">
                            <symbol id="ai:local:client">
                                <path fill="currentColor"
                                      d="M18 17a7 7 0 1 0-7-7 7 7 0 0 0 7 7m0-12a5 5 0 1 1-5 5 5 5 0 0 1 5-5"
                                      class="clr-i-outline clr-i-outline-path-1"/>
                                <path fill="currentColor"
                                      d="M30.47 24.37a17.16 17.16 0 0 0-24.93 0A2 2 0 0 0 5 25.74V31a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2v-5.26a2 2 0 0 0-.53-1.37M29 31H7v-5.27a15.17 15.17 0 0 1 22 0Z"
                                      class="clr-i-outline clr-i-outline-path-2"/>
                                <path fill="none" d="M0 0h36v36H0z"/>
                            </symbol>
                            <use xlink:href="#ai:local:client"></use>
                        </svg>
                        <p class="fw-500 fs-18 pt-5">تسجيل كمستخدم</p> <a href="ClientAuth.php" title="ClientAuth.php"
                                                                          class="absolute"></a></div>
                </section>
            </div>
        </section>
    </div>
</main>
<?php
include "layout/inc/footer.php";
include "layout/inc/toastr.php";
?>
</body>
</html>