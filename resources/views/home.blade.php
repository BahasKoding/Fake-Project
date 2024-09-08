<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kementerian Sosial Republik Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f39c12;
            --text-color: #333;
            --bg-color: #f4f7f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 0;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            list-style-type: none;
        }

        .navbar-item {
            margin-left: 2rem;
        }

        .navbar-link {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .navbar-link:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.1), rgba(243, 156, 18, 0.1));
        }

        .hero-content {
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #3a7bc8;
        }

        /* Sections */
        .section {
            padding: 5rem 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--primary-color);
        }

        /* Cards */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            flex: 1 1 300px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            padding: 3rem 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-section {
            flex: 1 1 300px;
            margin-bottom: 2rem;
        }

        .footer-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style-type: none;
        }

        .footer-link {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .social-icons {
            font-size: 1.5rem;
        }

        .social-icons a {
            color: #ccc;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: white;
        }

        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-container">
            <a href="#" class="navbar-logo">Kemensos RI</a>
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="#layanan" class="navbar-link">Layanan</a></li>
                <li class="navbar-item"><a href="#program" class="navbar-link">Program</a></li>
                <li class="navbar-item"><a href="#berita" class="navbar-link">Berita</a></li>
                <li class="navbar-item"><a href="/login" class="navbar-link">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container hero-content">
            <h1 class="hero-title">Kementerian Sosial Republik Indonesia</h1>
            <p class="hero-subtitle">Mewujudkan kesejahteraan sosial bagi seluruh rakyat Indonesia.</p>
            <a href="#layanan" class="btn">Jelajahi Layanan Kami</a>
        </div>
    </header>

    <!-- Layanan Section -->
    <section id="layanan" class="section">
        <div class="container">
            <h2 class="section-title">Layanan Utama</h2>
            <div class="card-container">
                <div class="card">
                    <i class="fas fa-hands-helping card-icon"></i>
                    <h3 class="card-title">Bantuan Sosial</h3>
                    <p>Memberikan bantuan langsung kepada masyarakat yang membutuhkan.</p>
                </div>
                <div class="card">
                    <i class="fas fa-users card-icon"></i>
                    <h3 class="card-title">Pemberdayaan Masyarakat</h3>
                    <p>Program untuk meningkatkan kemandirian dan kesejahteraan masyarakat.</p>
                </div>
                <div class="card">
                    <i class="fas fa-shield-alt card-icon"></i>
                    <h3 class="card-title">Perlindungan Sosial</h3>
                    <p>Menjamin hak-hak dasar dan perlindungan bagi kelompok rentan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="section">
        <div class="container">
            <h2 class="section-title">Program Unggulan</h2>
            <div class="card-container">
                <div class="card">
                    <h3 class="card-title">Program Keluarga Harapan</h3>
                    <p>Meningkatkan kualitas hidup keluarga miskin melalui akses layanan kesehatan dan pendidikan.</p>
                </div>
                <div class="card">
                    <h3 class="card-title">Bantuan Pangan Non-Tunai</h3>
                    <p>Membantu masyarakat miskin memenuhi kebutuhan pangan dan gizi melalui bantuan non-tunai.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="section">
        <div class="container">
            <h2 class="section-title">Berita Terkini</h2>
            <div class="card-container">
                <div class="card">
                    <h3 class="card-title">Peluncuran Program Baru</h3>
                    <p>Kementerian Sosial meluncurkan program baru untuk mendukung UMKM di daerah terpencil.</p>
                </div>
                <div class="card">
                    <h3 class="card-title">Kerjasama Internasional</h3>
                    <p>Indonesia menjalin kerjasama dengan PBB untuk program pengentasan kemiskinan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-section">
                <h3 class="footer-title">Tentang Kami</h3>
                <p>Kementerian Sosial Republik Indonesia berkomitmen untuk meningkatkan kesejahteraan sosial masyarakat Indonesia.</p>
            </div>
            <div class="footer-section">
                <h3 class="footer-title">Tautan Cepat</h3>
                <ul class="footer-links">
                    <li><a href="#layanan" class="footer-link">Layanan</a></li>
                    <li><a href="#program" class="footer-link">Program</a></li>
                    <li><a href="#berita" class="footer-link">Berita</a></li>
                    <li><a href="#" class="footer-link">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-title">Ikuti Kami</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // SweetAlert for logout success message
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#4a90e2'
                });
            @endif
        });
    </script>
</body>
</html>
