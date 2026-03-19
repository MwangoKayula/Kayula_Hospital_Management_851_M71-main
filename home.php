<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медицинская платформа - Поликлиники</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        header {
            background-color: #ffffff;
            color: rgb(3, 185, 28);
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            width: 100px;
            height: auto;
            margin-right: 20px;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .logo span {
            color: #4caf50;
        }
        
        /* User info in header - NEW */
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .welcome-message {
            color: #0056b3;
            font-weight: 500;
        }
        
        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }
        
        .logout-btn:hover {
            background-color: #ff3333;
            transform: translateY(-2px);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 40px;
        }
        
        nav ul li a {
            color: rgb(31, 160, 5);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
            cursor: pointer;
        }
        
        nav ul li a:hover {
            color: #1aa4d2;
        }
        
        /* Hero Section */
        .hero {
            background-color: #eeffef;
            padding: 60px 0;
            text-align: center;
            color: rgb(2, 33, 2);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%234caf50"/><circle cx="50" cy="50" r="40" fill="%2338a645" opacity="0.3"/></svg>');
            opacity: 0.1;
            z-index: 0;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        /* Slider Styles */
        .slider-container {
            position: relative;
            max-width: 750px;
            margin: 0 auto 30px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .slides-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .slide {
            min-width: 100%;
            height: 400px;
            position: relative;
        }
        
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 20px;
        }
        
        .nav-btn {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .nav-btn:hover {
            background-color: rgba(172, 243, 249, 0.5);
            transform: scale(1.1);
        }
        
        .dots-container {
            position: absolute;
            bottom: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dot.active {
            background-color: white;
            transform: scale(1.2);
        }
        
        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .hero p {
            font-size: 22px;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .btn {
            background-color: white;
            color: #4caf50;
            border: none;
            padding: 14px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        
        /* Services Section - ADDED ID for scrolling */
        .services {
            padding: 70px 0;
            background-color: white;
            scroll-margin-top: 100px; /* Prevents header from covering content when scrolling */
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 32px;
            color: #0056b3;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #4caf50;
            border-radius: 2px;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            background-color: #e9f7ef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            color: #4caf50;
        }
        
        .service-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #0056b3;
        }
        
        .service-card p {
            color: #666;
            margin-bottom: 20px;
        }
        
        .service-btn {
            display: inline-block;
            background-color: #0056b3;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .service-btn:hover {
            background-color: #004494;
            transform: translateY(-3px);
        }
        
        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: pointer;
        }
        
        .footer-links a:hover {
            color: #4caf50;
        }
        
        .copyright {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #34495e;
            font-size: 14px;
            color: #bdc3c7;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            nav ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 5px 10px;
            }
            
            .hero h1 {
                font-size: 28px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .btn {
                padding: 12px 25px;
                font-size: 16px;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .slide {
                height: 300px;
            }
            
            .nav-btn {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
            
            .user-info {
                margin-top: 10px;
                justify-content: center;
            }
        }
        
        /* Loading overlay - NEW */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            display: none;
        }
        
        .loading-overlay.active {
            display: flex;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #4caf50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header - MODIFIED to include PHP session info -->
    <header>
        <div class="container header-content">
            <img src="https://img.freepik.com/premium-vector/hospital-logo-vector_1277164-14205.jpg" alt="Company Logo" class="logo">
            <div class="logo">ПОЛИКЛИНИКИ<span></span></div>
            
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                // User is logged in
                $userName = $_SESSION['user_name'] ?? $_SESSION['username'];
                $userRole = $_SESSION['user_role'] ?? '';
                ?>
                <div class="user-info">
                    <span class="welcome-message">
                        <i class="fas fa-user-circle"></i> 
                        <?php echo htmlspecialchars($userName); ?> 
                        (<?php echo $userRole == 'doctor' ? 'Врач' : 'Пациент'; ?>)
                    </span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Выйти
                    </a>
                </div>
                <?php
            } else {
                // User not logged in - redirect to login page
                header("Location: index.html");
                exit();
            }
            ?>
            
            <nav>
                <ul>
                    <li><a href="#" id="homeLink">Главная</a></li>
                    <li><a href="#" id="servicesLink">Услуги</a></li>
                    <li><a href="Doctors_dashboard.html">Врачи</a></li>
                    <li><a href="#" id="contactsLink">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <!-- Hero Slider -->
            <div class="slider-container">
                <div class="slides-wrapper" id="slides">
                    <div class="slide">
                        <img src="https://dfcm.utoronto.ca/sites/default/files/styles/scale_width_1750/public/assets/news/image/iStock-1301555107_0.jpg?itok=KJG3yAQg" alt="Hospital">
                    </div>
                    <div class="slide">
                        <img src="https://img.freepik.com/premium-photo/young-doctor-russian-woman-isolated-white-background-showing-copy-space-palm-holding-another-hand-waist_1187-188130.jpg" alt="Медицинский персонал">
                    </div>
                    <div class="slide">
                        <img src="https://aartas.com/v1/public/assets/blog/1756186105child-doctor.webp" alt="Современное оборудование">
                    </div>
                </div>
                
                <!-- Navigation Arrows -->
                <div class="slider-nav">
                    <button class="nav-btn prev" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                    <button class="nav-btn next" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
                </div>
                
                <!-- Dots -->
                <div class="dots-container" id="dotsContainer">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                </div>
            </div>
            
            <h1>Найдите своего врача и запишитесь на прием</h1>
            <div class="btn-group">
                <button onclick="window.location.href='Doctors_dashboard.html'" class="btn">Записаться на приём</button>
                <button class="btn" id="learnMoreBtn">Смотрите больше</button>
            </div>
        </div>
    </section>

    <!-- Services Section - ADDED ID for scrolling -->
    <section class="services" id="servicesSection">
        <div class="container">
            <div class="section-title">
                <h2>Просмотр сервисов</h2>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h3>Аптека</h3>
                    <p>Современная медицинская клиника с полным спектром услуг для всей семьи</p>
                    <a href="#" class="service-btn">Подробнее</a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3>Служба неотложной помощи</h3>
                    <p>Круглосуточная экстренная медицинская помощь в любой точке города</p>
                    <a href="#" class="service-btn">Подробнее</a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3>Лабораторные услуги</h3>
                    <p>Точные и быстрые лабораторные исследования на современном оборудовании</p>
                    <a href="#" class="service-btn">Подробнее</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">ПОЛИКЛИНИКИ<span>.</span></div>
                <div class="footer-links">
                    <a href="#" id="footerAbout">О нас</a>
                    <a href="#" id="footerServices">Услуги</a>
                    <a href="Doctors_dashboard.html">Врачи</a>
                    <a href="#" id="footerContacts">Контакты</a>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 Поликлиники. Все права защищены.
            </div>
        </div>
    </footer>

    <script>
        // ========== SMOOTH SCROLLING FUNCTIONALITY ==========
        
        // Function to smoothly scroll to services section
        function scrollToServices() {
            const servicesSection = document.getElementById('servicesSection');
            if (servicesSection) {
                servicesSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
        
        // Function to scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Add click event listeners for all "Услуги" links
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation link
            const servicesLink = document.getElementById('servicesLink');
            if (servicesLink) {
                servicesLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    scrollToServices();
                });
            }
            
            // Footer services link
            const footerServices = document.getElementById('footerServices');
            if (footerServices) {
                footerServices.addEventListener('click', function(e) {
                    e.preventDefault();
                    scrollToServices();
                });
            }
            
            // Home link - scroll to top
            const homeLink = document.getElementById('homeLink');
            if (homeLink) {
                homeLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    scrollToTop();
                });
            }
            
            // Footer about link - scroll to top
            const footerAbout = document.getElementById('footerAbout');
            if (footerAbout) {
                footerAbout.addEventListener('click', function(e) {
                    e.preventDefault();
                    scrollToTop();
                });
            }
            
            // Contacts links - show message (you can customize this)
            const contactsLinks = document.querySelectorAll('#contactsLink, #footerContacts');
            contactsLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Контактная информация: г. Москва, ул. Медицинская, 1\nТел: +7 (495) 123-45-67\nEmail: info@polikliniki.ru');
                });
            });
            
            // Learn more button - scroll to services
            const learnMoreBtn = document.getElementById('learnMoreBtn');
            if (learnMoreBtn) {
                learnMoreBtn.addEventListener('click', function() {
                    scrollToServices();
                });
            }
            
            // Highlight active section while scrolling
            window.addEventListener('scroll', function() {
                const servicesSection = document.getElementById('servicesSection');
                if (servicesSection) {
                    const rect = servicesSection.getBoundingClientRect();
                    const isInView = rect.top <= 100 && rect.bottom >= 100;
                    
                    if (isInView) {
                        servicesLink.style.color = '#0056b3';
                        servicesLink.style.fontWeight = 'bold';
                    } else {
                        servicesLink.style.color = 'rgb(31, 160, 5)';
                        servicesLink.style.fontWeight = '700';
                    }
                }
            });
        });

        // ========== SLIDER FUNCTIONALITY (unchanged) ==========
        const slides = document.getElementById('slides');
        const slideImages = document.querySelectorAll('.slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dots = document.querySelectorAll('.dot');
        
        let currentSlide = 0;
        const slideWidth = 100;
        
        function updateSlider() {
            slides.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
            
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slideImages.length;
            updateSlider();
        }
        
        function prevSlide() {
            currentSlide = (currentSlide - 1 + slideImages.length) % slideImages.length;
            updateSlider();
        }
        
        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);
        
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentSlide = parseInt(dot.getAttribute('data-slide'));
                updateSlider();
            });
        });
        
        let slideInterval = setInterval(nextSlide, 5000);
        
        const sliderContainer = document.querySelector('.slider-container');
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        sliderContainer.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });
        
        // ========== SESSION CHECK ==========
        // Optional: Check session via AJAX to ensure user is still logged in
        function checkSession() {
            fetch('check_session.php')
                .then(response => response.json())
                .then(data => {
                    if (!data.logged_in) {
                        // User session expired, redirect to login
                        window.location.href = 'index.html?error=session_expired';
                    }
                })
                .catch(error => console.error('Session check failed:', error));
        }
        
        // Check session every 5 minutes
        setInterval(checkSession, 300000);
    </script>
</body>
</html>