<?php
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Piece</title>
    <link rel="icon" href="https://i.pinimg.com/564x/ab/a6/bb/aba6bb42cb08e35ac0d71e6044566b0a.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!--nav awal-->
    <nav class="navbar navbar-expand-lg sticky-top font-monospace"
        style="background-color: var(--bs-info-border-subtle);">
        <div class="container">
            <a class="navbar-brand" href="#">One Piece King Of Pirates</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutme">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-sun-fill theme-icon-active" data-theme-icon-active="bi-sun-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><button class="dropdown-item d-flex align-items-center" type="button"
                                    data-bs-theme-value="light">
                                    <i class="bi bi-sun-fill me-2 opacity-50" data-theme-icon="bi-sun-fill"></i>
                                    Light
                                </button>
                            </li>
                            <li><button class="dropdown-item d-flex align-items-center" type="button"
                                    data-bs-theme-value="dark">
                                    <i class="bi bi-moon-fill me-2 opacity-50" data-theme-icon="bi-moon-fill"></i>
                                    Dark
                                </button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--nav akhir-->
    <!--hero awal-->
    <section id="hero" class="text-center p-5 bg-info-subtle font-monospace text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/banner.jpg" class="img-fluid" width="300" alt="">
                <div>
                    <h1 class="fw-bold display-4">
                        Welcome to One Piece King Of Pirates
                    </h1>
                    <h4 class="lead display-6">
                        persahabatan tanpa batas, dan mimpi yang berlayar melampaui lautan.
                    </h4>
                    <h6>
                        <span id="tanggal"></span>
                        <span id="jam"></span>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!--hero akhir-->
    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);

                while ($row = $hasil->fetch_assoc()) {
                    ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["judul"] ?></h5>
                                <p class="card-text">
                                    <?= $row["isi"] ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">
                                    <?= $row["tanggal"] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- article end -->
    <!--gallery awal-->
    <section id="gallery" class="text-center p-5 bg-info-subtle font-monospace">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">All Of Story</h1>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql);

                    $activeClass = "active";
                    while ($row = $hasil->fetch_assoc()) {
                        ?>
                        <div class="carousel-item <?= $activeClass ?>">
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="Gallery Image" />
                                </div>
                            </div>
                        </div>
                        <?php
                        $activeClass = "";
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!--gallery akhir-->
    <!--schedule awal-->
    <section id="schedule" class="text-center container my-5 p-5 font-monospace">
        <h1 class="fw-bold display-4 pb-3">Schedule</h1>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">SENIN</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            REKAYASA PERANGKAT LUNAK<br>
                            09:30-12:00|H.5.6
                        </li>
                        <li class="list-group-item">
                            SISTEM OPERASI<br>
                            12:30-15:00|H.4.9
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">SELASA</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            SISTEM INFORMASI<br>
                            09:30 - 12:00|H.4.2
                        </li>
                        <li class="list-group-item">
                            BASIS DATA<br>
                            12:30 - 14:10|D.3.M
                        </li>
                        <li class="list-group-item">
                            PENDIDIKAN KEWARGANEGARAAN<br>
                            18:30 - 20:10|D.3.M
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">RABU</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            LOGIKA INFORMATIKA<br>
                            12:30-15:00|H.4.10
                        </li>
                        <li class="list-group-item">
                            PROBABILITAS DAN STATISTIKA<br>
                            15:30-18:00|H.4.8
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">KAMIS</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            BASIS DATA<br>
                            07:00-08:40|H.5.1
                        </li>
                        <li class="list-group-item">
                            PEMROGRAMAN BERBASIS WEB<br>
                            08:40-10:20|D.2.J
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">JUMAT</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            FREE
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex ">
                <div class="card w-100">
                    <div class="card-header bg-info-subtle">SABTU</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            FREE
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--schedule akhir awal-->
    <!--about me awal-->
    <section id="aboutme" class="text-center p-5 bg-info-subtle">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center text-md-start">
                    <div class="d-md-flex align-items-center gap-4">
                        <img src="https://i.pinimg.com/564x/ab/a6/bb/aba6bb42cb08e35ac0d71e6044566b0a.jpg"
                            class="rounded-circle mb-4 m-4" width="360" alt="">
                        <div>
                            <p class="text-muted mb-0">
                                A11.2023.15132
                            </p>
                            <h1 class="fw-bold">Hanaafi Arya Ditta</h1>
                            <p class="text-muted mb-0">
                                Program Studi Teknik Informatika
                            </p>
                            <p><a href="https://dinus.ac.id/"><b>Universitas Dian Nuswantoro</b></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--about me akhir-->
    <!--footer awal-->
    <footer class="text-center p-5 font-monospace" style="background-color: var(--bs-info-border-subtle);>
    <div class=" container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="">Follow Us</h5>
                <a href="https://www.instagram.com/aryahanaafi" class=" me-3"><i class="bi bi-instagram h2"></i></a>
                <a href="https://twitter.com/" class=" me-3"><i class="bi bi-twitter h2"></i></a>
                <a href="https://wa.me/" class=""><i class="bi bi-whatsapp h2"></i></a>
            </div>
            <div class="col-md-4 mb-2">
                <h5 class="">Contact Us</h5>
                <p class=""> Email us at: <a href="aryahanaafi115@gmail.com" class="">aryahanaafi115@gmail.com</a></p>
            </div>
            <div class="col-md-4 mb-2">
                <h5 class="">About Us</h5>
                <p class="">Hanaafi Arya &copy; 2024. All rights reserved.</p>
            </div>
        </div>
        </div>
    </footer>
    <!--footer akhir-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <script type="text/javascript">
        window.setTimeout("tampilanWaktu()", 1000);

        function tampilanWaktu() {
            var waktu = new Date();
            var bulan = waktu.getMonth() + 1;

            setTimeout("tampilanWaktu()", 1000);
            document.getElementById("tanggal").innerHTML =
                waktu.getDate() + "/" + waktu.getFullYear();
            document.getElementById("jam").innerHTML =
                waktu.getHours() +
                ":" +
                waktu.getMinutes() +
                ":" +
                waktu.getSeconds();
        }
    </script>

    <script>
        /*!
    * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
    * Copyright 2011-2024 The Bootstrap Authors
    * Licensed under the Creative Commons Attribution 3.0 Unported License.
    */
        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme()
                if (storedTheme) {
                    return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
                if (theme === 'auto') {
                    document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme)
                }
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#bd-theme')

                if (!themeSwitcher) {
                    return
                }

                const themeSwitcherText = document.querySelector('#bd-theme-text')
                const activeThemeIcon = document.querySelector('.theme-icon-active')
                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                const iconOfActiveBtn = btnToActive.querySelector('i').dataset.themeIcon

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active')
                    element.setAttribute('aria-pressed', 'false')
                })

                btnToActive.classList.add('active')
                btnToActive.setAttribute('aria-pressed', 'true')
                activeThemeIcon.classList.remove(activeThemeIcon.dataset.themeIconActive)
                activeThemeIcon.classList.add(iconOfActiveBtn)
                activeThemeIcon.dataset.iconActive = iconOfActiveBtn
                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
                themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

                if (focus) {
                    themeSwitcher.focus()
                }
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            setStoredTheme(theme)
                            setTheme(theme)
                            showActiveTheme(theme, true)
                        })
                    })
            })
        })()
    </script>
</body>

</html>