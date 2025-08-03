<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content>
        <meta name="author" content>
        
        <title>BRAC University Cultural Club</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link
            href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;400;700&display=swap"
            rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-festava-live.css" rel="stylesheet">

        <!-- Swiper CSS -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <!-- Ionicons -->
        <script type="module"
            src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule
            src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <style>
            /* SB Members Slideshow Styles */
            @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600&display=swap");
            
            /* Enhanced Sign Up Form Styles */
            .signup-title {
                font-size: 3rem;
                font-weight: 800;
                background: linear-gradient(135deg, #e76f2c, #f3d35c);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 2rem;
                animation: titleGlow 3s ease-in-out infinite;
            }
            
            @keyframes titleGlow {
                0%, 100% { filter: brightness(1); }
                50% { filter: brightness(1.2); }
            }
            
            .signup-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 25px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.15),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
                overflow: hidden;
                position: relative;
            }
            
            .signup-container::before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: linear-gradient(45deg, #e76f2c, #f3d35c, #e76f2c);
                border-radius: 25px;
                z-index: -1;
                opacity: 0.3;
                animation: borderGlow 4s ease-in-out infinite;
                background-size: 400% 400%;
            }
            
            @keyframes borderGlow {
                0%, 100% { 
                    opacity: 0.3; 
                    background-position: 0% 50%;
                }
                50% { 
                    opacity: 0.6; 
                    background-position: 100% 50%;
                }
            }
            
            .signup-tab, .login-tab, .maps-tab {
                background: linear-gradient(135deg, #f8f9fa, #e9ecef);
                border: none;
                border-radius: 15px;
                padding: 12px 24px;
                margin: 0 5px;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            
            .signup-tab::before, .login-tab::before, .maps-tab::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(231, 111, 44, 0.2), transparent);
                transition: left 0.5s ease;
            }
            
            .signup-tab:hover::before, .login-tab:hover::before, .maps-tab:hover::before {
                left: 100%;
            }
            
            .signup-tab:hover, .login-tab:hover, .maps-tab:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(231, 111, 44, 0.3);
            }
            
            .signup-tab.active {
                background: linear-gradient(135deg, #e76f2c, #f3d35c);
                color: white;
                box-shadow: 0 8px 25px rgba(231, 111, 44, 0.4);
            }
            
            .login-tab.active {
                background: linear-gradient(135deg, #007bff, #0056b3);
                color: white;
                box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
            }
            
            .maps-tab.active {
                background: linear-gradient(135deg, #28a745, #1e7e34);
                color: white;
                box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            }
            
            .contact-form {
                padding: 40px;
                background: rgba(255, 255, 255, 0.8);
                border-radius: 20px;
                backdrop-filter: blur(10px);
            }
            
            .form-control {
                background: rgba(255, 255, 255, 0.9);
                border: 2px solid rgba(231, 111, 44, 0.1);
                border-radius: 15px;
                padding: 15px 20px;
                font-size: 1rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            
            .form-control::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(231, 111, 44, 0.1), transparent);
                transition: left 0.6s ease;
            }
            
            .form-control:focus::before {
                left: 100%;
            }
            
            .form-control:focus {
                background: rgba(255, 255, 255, 1);
                border-color: #e76f2c;
                box-shadow: 0 0 20px rgba(231, 111, 44, 0.2);
                transform: translateY(-2px);
                outline: none;
            }
            
            .form-control::placeholder {
                color: #6c757d;
                font-weight: 400;
            }
            
            .form-label {
                font-weight: 600;
                color: #333;
                margin-bottom: 10px;
                display: block;
            }
            
            .form-check-input {
                border: 2px solid #e76f2c;
                border-radius: 50%;
                transition: all 0.3s ease;
            }
            
            .form-check-input:checked {
                background-color: #e76f2c;
                border-color: #e76f2c;
                box-shadow: 0 0 10px rgba(231, 111, 44, 0.3);
            }
            
            .form-check-label {
                font-weight: 500;
                color: #333;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .form-check-label:hover {
                color: #e76f2c;
            }
            
            .form-check-inline {
                margin-right: 20px;
            }
            
            /* Panel Year Selector Styles */
            .panel-year-selector {
                max-width: 400px;
                margin: 0 auto;
            }
            
            .panel-year-dropdown {
                background: rgba(255, 255, 255, 0.95);
                border: 2px solid #e76f2c;
                border-radius: 15px;
                padding: 12px 20px;
                font-size: 1.1rem;
                font-weight: 600;
                color: #333;
                transition: all 0.3s ease;
            }
            
            .panel-year-dropdown:focus {
                background: rgba(255, 255, 255, 1);
                border-color: #f3d35c;
                box-shadow: 0 0 20px rgba(231, 111, 44, 0.3);
                outline: none;
            }
            
            .panel-year-dropdown:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(231, 111, 44, 0.2);
            }
            
            /* Panel Content Area */
            .panel-content-area {
                position: relative;
                min-height: 500px;
            }
            
            .panel-members-container,
            .sb-members-container {
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            
            .panel-members-container.fade-out,
            .sb-members-container.fade-out {
                opacity: 0;
                transform: translateY(20px);
            }
            
            .panel-members-container.fade-in,
            .sb-members-container.fade-in {
                opacity: 1;
                transform: translateY(0);
            }
            
            /* Three member layout */
            .three-member .col-lg-5:nth-child(4) {
                margin-top: 0 !important;
            }
            
            .three-member .panel-members-grid {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
            }
            
            .three-member .panel-members-grid .col-lg-5 {
                flex: 0 0 auto;
                max-width: 300px;
            }
            
            /* Loading spinner */
            .panel-loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 10;
            }
            
            .spinner {
                width: 50px;
                height: 50px;
                border: 4px solid rgba(231, 111, 44, 0.3);
                border-top: 4px solid #e76f2c;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            textarea.form-control {
                resize: vertical;
                min-height: 100px;
                font-family: inherit;
            }
            
            .form-control[type="submit"], button[type="submit"] {
                background: linear-gradient(135deg, #e76f2c, #f3d35c);
                border: none;
                border-radius: 15px;
                padding: 15px 30px;
                font-size: 1.1rem;
                font-weight: 700;
                color: white;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(231, 111, 44, 0.3);
            }
            
            .form-control[type="submit"]::before, button[type="submit"]::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s ease;
            }
            
            .form-control[type="submit"]:hover::before, button[type="submit"]:hover::before {
                left: 100%;
            }
            
            .form-control[type="submit"]:hover, button[type="submit"]:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 30px rgba(231, 111, 44, 0.5);
            }
            
            /* Floating particles for signup section */
            .signup-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
                z-index: 1;
            }
            
            .signup-particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: linear-gradient(45deg, #e76f2c, #f3d35c);
                border-radius: 50%;
                animation: signupFloat 8s infinite linear;
                opacity: 0.6;
            }
            
            @keyframes signupFloat {
                0% {
                    transform: translateY(100vh) rotate(0deg) scale(0);
                    opacity: 0;
                }
                10% {
                    opacity: 0.6;
                    transform: scale(1);
                }
                90% {
                    opacity: 0.6;
                }
                100% {
                    transform: translateY(-100px) rotate(360deg) scale(0);
                    opacity: 0;
                }
            }
            
            /* Enhanced admin check container */
            .admin-check-container {
                padding: 40px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 20px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(231, 111, 44, 0.1);
            }
            
            .admin-check-icon {
                width: 120px;
                height: 120px;
                background: linear-gradient(135deg, #e76f2c, #f3d35c);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                font-size: 3.5rem;
                color: white;
                box-shadow: 0 15px 40px rgba(231, 111, 44, 0.4);
                animation: iconFloat 3s ease-in-out infinite;
            }
            
            @keyframes iconFloat {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            .admin-check-title {
                font-size: 2rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 15px;
            }
            
            .admin-check-description {
                color: #666;
                font-size: 1.1rem;
                margin-bottom: 30px;
            }
            
            .admin-options {
                display: flex;
                gap: 20px;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .admin-options .btn {
                padding: 12px 24px;
                border-radius: 15px;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            
            .admin-options .btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s ease;
            }
            
            .admin-options .btn:hover::before {
                left: 100%;
            }
            
            .admin-options .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }
            
            /* Responsive design */
            @media (max-width: 768px) {
                .signup-title {
                    font-size: 2.5rem;
                }
                
                .contact-form {
                    padding: 30px 20px;
                }
                
                .admin-options {
                    flex-direction: column;
                    gap: 15px;
                }
                
                .admin-options .btn {
                    width: 100%;
                }
            }

            .sb-section {
                position: relative;
                padding: 80px 0;
                background: url(https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/8727c9b1-be21-4932-a221-4257b59a74dd);
                background-repeat: no-repeat;
                backdrop-filter: blur(30%);
                -webkit-backdrop-filter: blur(30%);
                animation: slidein 120s forwards infinite alternate;
            }

            @keyframes slidein {
                0%, 100% {
                    background-position: 20% 0%;
                    background-size: 3400px;
                }
                50% {
                    background-position: 100% 0%;
                    background-size: 2400px;
                }
            }

            .sb-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(5px);
                -webkit-backdrop-filter: blur(5px);
                z-index: 1;
            }

            .sb-section .container {
                position: relative;
                z-index: 2;
            }

            .album-cover {
                width: 100%;
                max-width: 100vw;
                box-sizing: border-box;
            }

            .sb-swiper {
                width: 100%;
                max-width: 100vw;
                box-sizing: border-box;
                padding: 40px 0 100px;
            }

            .sb-swiper .swiper-slide {
                position: relative;
                width: 300px;
                height: 300px;
                border-radius: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                background: #fff;
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
                transition: 0.3s;
                min-width: 120px;
                min-height: 120px;
            }

            .sb-swiper .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
            }

            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: rgba(0, 0, 0, 0.5);
                opacity: 0;
                transition: opacity 0.3s;
                border-radius: 10px;
            }

            .sb-swiper .swiper-slide:hover .overlay {
                opacity: 1;
            }

            .sb-swiper .swiper-slide .overlay ion-icon {
                font-size: 3rem;
                color: #fff;
                transition: transform 0.3s;
            }

            .sb-swiper .swiper-slide:hover .overlay ion-icon {
                transform: scale(1.2);
            }

            .member-name {
                position: absolute;
                bottom: -60px;
                left: 0;
                right: 0;
                text-align: center;
                color: white;
                font-size: 1.1rem;
                font-weight: 500;
                padding: 5px;
                background: rgba(0, 0, 0, 0.7);
                border-radius: 0 0 10px 10px;
                transition: all 0.3s ease;
                opacity: 0;
                transform: translateY(20px);
            }

            .member-name .name {
                display: block;
                font-size: 1rem;
                margin-bottom: 1px;
            }

            .member-name .position {
                display: block;
                font-size: 0.8rem;
                color: #ffd700;
                font-weight: 400;
            }

            .sb-swiper .swiper-slide-active .member-name {
                opacity: 1;
                transform: translateY(0);
                bottom: 0;
            }
 
            .sb-section-title {
                text-align: center;
                color: white;
                margin-bottom: 40px;
                font-size: 2.5rem;
                font-weight: 600;
            }

            .album-img-reflect .main-img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 10px 10px 0 0;
                display: block;
            }
            .album-img-reflect .reflection {
                width: 100%;
                height: 40px;
                overflow: hidden;
                position: relative;
                display: block;
            }

            #mainHeader, #mainNavbar {
                transition: transform 0.5s, opacity 0.5s;
            }
            #mainHeader.scrolled {
                transform: translateY(-100%);
                opacity: 0;
                pointer-events: none;
            }
            #mainNavbar {
                transform: translateY(-100%);
                opacity: 0;
                pointer-events: none;
            }
            #mainNavbar.scrolled {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }

            .site-header, #mainNavbar {
                padding-top: 4px !important;
                padding-bottom: 4px !important;
                min-height: 48px;
                display: flex;
                align-items: center;
            }
            .site-header .navbar-brand, #mainNavbar .navbar-brand {
                display: flex;
                align-items: center;
                font-weight: bold;
                font-size: 1.5em;
                color: #222;
                gap: 0.5em;
            }
            #mainNavbar .navbar-brand {
                color: #fff;
            }
            .site-header .navbar-brand img, #mainNavbar .navbar-brand img {
                height: 1.2em;
                margin-right: 0.5em;
            }
            #mainNavbar .navbar-nav {
                gap: 1rem !important;
            }
            #mainNavbar .nav-link {
                font-size: 1em;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            .site-header .custom-btn, #mainNavbar .custom-btn {
                border-radius: 2em;
                padding: 8px 24px;
                font-size: 1em;
                font-weight: bold;
                margin-left: 1.5em;
            }
            #mainNavbar .custom-btn {
                background: #e76f2c;
                color: #fff;
            }

            @keyframes glow {
                0% { text-shadow: 0 0 10px #e76f2c, 0 2px 4px #000, 0 0 1px #fff; }
                100% { text-shadow: 0 0 20px #f3d35c, 0 2px 8px #e76f2c, 0 0 4px #fff; }
            }

            .hero-section h1 {
                font-size: 2.1rem;
                font-weight: 900;
                letter-spacing: 2px;
                color: #fff;
                text-shadow: 0 0 10px #e76f2c, 0 2px 4px #000, 0 0 1px #fff;
                animation: glow 2s ease-in-out infinite alternate;
                position: relative;
                z-index: 3;
                margin-top: 0.5em;
                animation: fadeInHero 1.6s ease-in;
                opacity: 0;
                animation-fill-mode: forwards;
            }

            @keyframes fadeInHero {
                from { opacity: 0; transform: translateY(24px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .hero-section .btn.custom-btn {
                font-size: 1rem;
                padding: 8px 28px;
            }

            .site-header .container {
                padding-left: 12px !important;
            }
            .site-header .col-lg-3 {
                padding-left: 0 !important;
                margin-left: 0 !important;
            }

            .about-text-info {
                padding-top: 6px;
                padding-bottom: 6px;
                padding-left: 18px;
                padding-right: 18px;
                border-radius: 18px;
                background: rgba(255,255,255,0.32);
                box-shadow: 0 2px 12px #0001;
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .about-text-icon {
                font-size: 2rem;
            }
            .about-text-info h6 {
                margin-bottom: 0;
                font-size: 1.1rem;
            }
            .about-text-info p {
                margin-bottom: 0;
                font-size: 0.95rem;
            }

            .artists-thumb:hover .artists-image {
                filter: brightness(0.92) saturate(1.1);
                transform: scale(1.08);
                box-shadow:
                    0 0 0 6px #fff, /* white border for separation */
                    0 0 32px 12px #f3d35c, /* strong yellow glow */
                    0 0 48px 24px #e76f2c88; /* orange outer glow */
                border-radius: 12px;
            }
            .artists-image {
                transition: filter 0.3s, transform 0.4s, box-shadow 0.4s;
                border-radius: 12px;
            }

            .artists-image-wrap {
                border-radius: 12px;
                overflow: hidden;
            }

            .form-label + .form-check-inline {
                margin-left: 1.2em;
            }

            @media (max-width: 768px) {
                .container {
                    width: 100%;
                    padding: 0 15px;
                }
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .event-schedule-container {
                max-width: 1150px;
                margin: 40px auto;
                padding: 32px 16px;
                border-radius: 24px;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.333) 60%, rgba(255, 200, 2, 0.576) 100%);
                backdrop-filter: blur(8px);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.543);
            }

            .event-schedule-header {
                text-align: center;
                font-size: 2.8rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 32px;
                background: linear-gradient(90deg, #d94c00, #ffc802, #e76f2c);
                background-size: 200% 100%;
                animation: headerGradient 4s linear infinite;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            @keyframes headerGradient {
                0% { background-position: 0% 50%; }
                100% { background-position: 100% 50%; }
            }

            .event-cards-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 28px;
            }

            .event-card {
                position: relative;
                border-radius: 18px;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.08);
                box-shadow: 0 4px 24px 0 rgb(31, 38, 135);
                transition: transform 0.3s, box-shadow 0.3s;
                cursor: pointer;
                min-height: 320px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
            }

            .event-card:hover {
                transform: scale(1.04) translateY(-8px);
                box-shadow: 0 8px 32px 0 #f3d35c88, 0 0 0 4px #e76f2c55;
            }

            .event-card-bg {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background-size: cover;
                background-position: center;
                filter: blur(1px) brightness(0.7);
                z-index: 1;
                transition: filter 0.3s;
            }

            .event-card:hover .event-card-bg {
                filter: blur(0) brightness(0.85);
            }

            .event-card-content {
                position: relative;
                z-index: 2;
                padding: 32px 20px 20px 20px;
                color: #fff;
                text-align: left;
                background: linear-gradient(0deg, rgba(30,30,40,0.85) 70%, rgba(30,30,40,0.1) 100%);
                border-radius: 0 0 18px 18px;
            }

            .event-icon {
                font-size: 2.2rem;
                color: #ffd700;
                margin-bottom: 0.5rem;
                display: inline-block;
            }

            .event-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 0.3rem;
            }

            .event-time {
                font-size: 1.1rem;
                margin-bottom: 0.2rem;
                color: #f3d35c;
            }

            .event-by {
                font-size: 1rem;
                color: #ffd700;
                margin-bottom: 0.2rem;
            }

            @media (max-width: 600px) {
                .event-schedule-header {
                    font-size: 2rem;
                }
                .event-card-content {
                    padding: 20px 10px 10px 10px;
                }
            }
        </style>
        <style>
        /* --- Responsive Fixes for Panel Section and Google Map --- */
        @media (max-width: 768px) {
          /* Fix panel section overlap */
          .artists-section .row > [class^="col-"] {
            margin-top: 0 !important;
          }
          .artists-thumb {
            margin-bottom: 32px;
          }
          .artists-thumb .artists-image-wrap img {
            height: auto !important;
            max-height: 340px;
            object-fit: cover;
          }
          /* Remove negative margin on mobile */
          .artists-section [style*="margin-top: -"] {
            margin-top: 0 !important;
          }
          /* Google Map responsive */
          .google-map {
            width: 100% !important;
            min-width: 0 !important;
            height: 220px !important;
            border-radius: 12px !important;
            margin-bottom: 16px;
          }
        }
        </style>
                <style>
        /* Admin Check Styles */
        .admin-check-container {
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .admin-check-icon {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .admin-check-title {
            color: #333;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .admin-check-description {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .admin-options {
            margin-top: 30px;
        }
        
        .admin-options .btn {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            min-width: 180px;
        }
        
        .admin-options .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
        }
        
        /* Notification Styles */
        .custom-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        .custom-notification.show {
            transform: translateX(0);
        }
        
        .custom-notification.warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }
        
        .custom-notification.success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        @media (max-width: 768px) {
          .contact-form-body .form-check,
          .contact-form-body .form-check-inline {
            display: flex !important;
            align-items: center !important;
            margin-bottom: 16px !important;
            margin-right: 0 !important;
            width: 100%;
            cursor: pointer;
            position: relative;
            padding-left: 0 !important;
            min-height: 36px;
          }
          .form-check-input[type="radio"] {
            margin-right: 10px;
            margin-left: 0 !important;
            width: 28px;
            height: 28px;
            min-width: 28px;
            min-height: 28px;
            display: inline-block;
            vertical-align: middle;
          }
          .form-check-label {
            font-size: 1.12em;
            flex: 1;
            cursor: pointer;
            user-select: none;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            height: 28px;
          }
          /* Target the label for 'Current Member' radio */
          label[for="status-current"] {
            margin-left: 16px;
          }
          
          .admin-options .btn {
            min-width: 150px;
            padding: 10px 20px;
            font-size: 0.9rem;
          }
        }
        </style>
        <!--

TemplateMo 583 BUCuC

https://templatemo.com/tm-583-festava-live

-->
    </head>

    <body>
        <!-- Mobile Sidebar Navigation (only visible on mobile) -->
        <div id="mobileSidebarOverlay" class="mobile-sidebar-overlay"></div>
        <nav id="mobileSidebar" class="mobile-sidebar">
            <div class="sidebar-profile">
                <img src="images/logopng.png" alt="Club Logo"
                    class="sidebar-profile-img">
                <div class="sidebar-profile-info">
                    <strong>BRACU Cultural Club</strong>
                    <span>Official</span>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li><a href="#section_1"><i class="fa fa-home"></i>
                        Home</a></li>
                <li><a href="#section_2"><i class="fa fa-info-circle"></i>
                        About</a></li>
                <li><a href="#section_3"><i class="fa fa-users"></i>
                        Panel</a></li>
                <li><a href="#section_4"><i class="fa fa-star"></i> Sb
                        Members</a></li>
                <li><a href="#section_5"><i class="fa fa-calendar"></i>
                        Schedule</a></li>
                <li><a href="#footer"><i class="fa fa-user-plus"></i> Sign
                        Up</a></li>
            </ul>
            <div class="sidebar-footer">
                <a href="#friend"><i class="fa fa-share-alt"></i> Tell a
                    Friend</a>
                <a href="#help"><i class="fa fa-question-circle"></i> Help &
                    Feedback</a>
            </div>
        </nav>
        <button id="sidebarToggle" class="sidebar-toggle-btn"
            aria-label="Open navigation menu">
            <span class="sidebar-toggle-bar"></span>
            <span class="sidebar-toggle-bar"></span>
            <span class="sidebar-toggle-bar"></span>
        </button>
        <!-- End Mobile Sidebar Navigation -->

        <main>

            <header class="site-header" id="mainHeader">
                <div class="container">
                    <div class="row align-items-center">
                        <div
                            class="col-lg-3 col-12 d-flex flex-wrap align-items-center">
                            <a class="navbar-brand d-flex align-items-center"
                                href="index.php"
                                style="color: #222; font-weight: bold; font-size: 1.5em;">
                                <img src="images/logopng.png" alt="Club Logo"
                                    class="me-2" style="height: 1.2em;">
                                BRAC University Cultural Club
                            </a>
                        </div>
                        <div
                            class="col-lg-9 col-12 d-flex justify-content-lg-end align-items-center">
                            <ul
                                class="navbar-nav flex-row align-items-center ms-auto me-lg-5"
                                style="gap: 1.5rem;">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll"
                                        href="#section_1"
                                        style="color: #222; font-weight: bold; font-size: 1em;">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll"
                                        href="#section_2"
                                        style="color: #222; font-weight: bold; font-size: 1em;">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll"
                                        href="#section_3"
                                        style="color: #222; font-weight: bold; font-size: 1em;">Panel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll"
                                        href="#section_4"
                                        style="color: #222; font-weight: bold; font-size: 1em;">Sb
                                        Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll"
                                        href="#section_5"
                                        style="color: #222; font-weight: bold; font-size: 1em;">Schedule</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn custom-btn ms-4"
                                        href="#footer"
                                        style="background: #e76f2c; color: #fff; font-weight: bold; border-radius: 2em; padding: 8px 24px; font-size: 1em;">Sign
                                        Up</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center"
                        href="index.php">
                        <img src="images/logo.png" alt="Club Logo" class="me-2"
                            style="height: 1.5em;">
                        BUCuC
                    </a>

                    <a href="ticket.html"
                        class="btn custom-btn d-lg-none ms-auto me-4"
                        style="background: #e76f2c; color: #fff; font-weight: bold; border-radius: 2em; padding: 8px 24px; font-size: 1em;">Sign
                        Up</a>

                    <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul
                            class="navbar-nav align-items-lg-center ms-auto me-lg-5">
                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#section_1">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#section_2">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#section_3">Panel</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#section_4">Sb Members</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#section_5">Schedule</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll"
                                    href="#very-bottom">Contact</a>
                            </li>
                        </ul>

                        <a href="#footer"
                            class="btn custom-btn d-lg-block d-none"
                            style="background: #e76f2c; color: #fff; font-weight: bold; border-radius: 2em; padding: 8px 24px; font-size: 1em;">Sign
                            Up</a>
                    </div>
                </div>
            </nav>

            <section class="hero-section" id="section_1">
                <div class="section-overlay"></div>

                <div
                    class="container d-flex justify-content-center align-items-center">
                    <div class="row">

                        <div class="col-12 mt-auto mb-5 text-center">
                            <h1 class="text-white mb-5">BRAC University Cultural
                                Club</h1>
                            <a class="btn custom-btn smoothscroll"
                                href="#section_2">Let's begin</a>
                        </div>

                        <div
                            class="col-lg-12 col-12 mt-auto d-flex flex-column flex-lg-row text-center">
                            <div class="date-wrap">
                                <h5 class="text-white">
                                    <i class="custom-icon bi-geo-alt me-2"></i>
                                    BRAC University Cultural Club
                                </h5>
                            </div>

                            <div class="location-wrap mx-auto py-3 py-lg-0">
                                <h5 class="text-white">

                                </h5>
                            </div>

                            <div class="social-share">
                                <ul
                                    class="social-icon d-flex align-items-center justify-content-center">
                                    <span class="text-white me-3">Share:</span>

                                    <li class="social-icon-item">
                                        <a href="https://www.facebook.com/bucuc"
                                            class="social-icon-link"
                                            target="_blank">
                                            <span class="bi-facebook"></span>
                                        </a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a
                                            href="https://www.youtube.com/@bracuniversityculturalclub717"
                                            class="social-icon-link"
                                            target="_blank">
                                            <span class="bi-youtube"></span>
                                        </a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a
                                            href="https://www.instagram.com/bucuclive/"
                                            class="social-icon-link"
                                            target="_blank">
                                            <span class="bi-instagram"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="video-wrap">
                    <video autoplay loop muted class="custom-video" poster>
                        <source src="video/pexels-2022395.mp4" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>

            <section class="about-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div
                            class="col-lg-6 col-12 mb-4 mb-lg-0 d-flex align-items-center">
                            <div class="services-info">
                                <h2 class="text-white mb-4">BRAC University
                                    Cultural Club</h2>

                                <p class="text-white"><strong>Publish
                                        Date:</strong> March 19th, 2016</p>

                                <p class="text-white">BRAC University Cultural
                                    Club organized an event to welcome new
                                    members who have signed up for the club on
                                    18 March 2016. The program started with the
                                    introduction of the existing club members.
                                    Video presentations were shown to give the
                                    students a brief synopsis about the
                                    activities of the Club. Students were also
                                    introduced with the Assistant Executive
                                    Panel. The event covered few dance
                                    performances, songs, and fun sessions.</p>

                                <h6 class="text-warning mt-4">Talent
                                    Showcase</h6>

                                <p class="text-white">Afterward, the new members
                                    were asked to come up on the stage and
                                    introduce themselves and show what they were
                                    capable of. This is where all the fun began.
                                    All the performers came on stage and gave
                                    their best shot trying to impress the judges
                                    with their unique skills set. Some baffled
                                    the judges with their voice and some blew
                                    the judges with amazement with their dance
                                    skills.</p>

                                <h6 class="text-warning mt-4">Recruitment of New
                                    Faces</h6>

                                <p class="text-white">At the end of the event,
                                    the club found some brilliant faces to
                                    recruit for the next generation of BRAC
                                    University Cultural Club.</p>

                                <h6 class="text-warning mt-4">Future Plans</h6>

                                <p class="text-white">The club aims to organize
                                    more interactive and engaging events in the
                                    future, including cultural festivals, talent
                                    hunts, and workshops to nurture the
                                    creativity of its members. Stay tuned for
                                    more updates!</p>

                                <div class="mt-4">
                                    <a href="#footer"
                                        class="btn btn-outline-light click-scroll"
                                        onclick="window.scrollTo({top:document.body.scrollHeight, behavior:'smooth'}); return false;">Contact
                                        Us</a>
                                    <a href="#section_5"
                                        class="btn btn-warning ms-2">View
                                        Schedule</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div id="happyMomentCarousel" class="carousel slide"
                                data-bs-ride="carousel" data-bs-interval="2000">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="about-text-wrap">
                                            <img src="images/2nd.JPG"
                                                class="about-image img-fluid">
                                            <div class="about-text-info d-flex">
                                                <div
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width:56px; height:56px; border-radius:50%; background:#F3D35C; overflow:hidden;">
                                                    <img src="images/logo.png"
                                                        alt="Club Logo"
                                                        style="height:36px; width:36px; object-fit:contain; display:block; margin:0;">
                                                </div>
                                                <div class="ms-4">
                                                    <h6>A Happy Moment</h6>
                                                    <p class="mb-0">Our Amazing
                                                        Festival Experience with
                                                        BRACU</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="about-text-wrap">
                                            <img src="images/slide2.jpg"
                                                class="about-image img-fluid">
                                            <div class="about-text-info d-flex">
                                                <div
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width:56px; height:56px; border-radius:50%; background:#F3D35C; overflow:hidden;">
                                                    <img src="images/logo.png"
                                                        alt="Club Logo"
                                                        style="height:36px; width:36px; object-fit:contain; display:block; margin:0;">
                                                </div>
                                                <div class="ms-4">
                                                    <h6>Festival Fun</h6>
                                                    <p class="mb-0">Dancing and
                                                        Singing with Friends</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="about-text-wrap">
                                            <img src="images/slide3.jpg"
                                                class="about-image img-fluid">
                                            <div class="about-text-info d-flex">
                                                <div
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width:56px; height:56px; border-radius:50%; background:#F3D35C; overflow:hidden;">
                                                    <img src="images/logo.png"
                                                        alt="Club Logo"
                                                        style="height:36px; width:36px; object-fit:contain; display:block; margin:0;">
                                                </div>
                                                <div class="ms-4">
                                                    <h6>Memorable Night</h6>
                                                    <p class="mb-0">A Night to
                                                        Remember</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="about-text-wrap">
                                            <img src="images/slide4.jpg"
                                                class="about-image img-fluid">
                                            <div class="about-text-info d-flex">
                                                <div
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width:56px; height:56px; border-radius:50%; background:#F3D35C; overflow:hidden;">
                                                    <img src="images/logo.png"
                                                        alt="Club Logo"
                                                        style="height:36px; width:36px; object-fit:contain; display:block; margin:0;">
                                                </div>
                                                <div class="ms-4">
                                                    <h6>Team Spirit</h6>
                                                    <p class="mb-0">Working
                                                        Together for Success</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="about-text-wrap">
                                            <img src="images/slide5.jpg"
                                                class="about-image img-fluid">
                                            <div class="about-text-info d-flex">
                                                <div
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width:56px; height:56px; border-radius:50%; background:#F3D35C; overflow:hidden;">
                                                    <img src="images/logo.png"
                                                        alt="Club Logo"
                                                        style="height:36px; width:36px; object-fit:contain; display:block; margin:0;">
                                                </div>
                                                <div class="ms-4">
                                                    <h6>Grand Finale</h6>
                                                    <p class="mb-0">Ending on a
                                                        High Note</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev"
                                    type="button"
                                    data-bs-target="#happyMomentCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"
                                        aria-hidden="true"></span>
                                    <span
                                        class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next"
                                    type="button"
                                    data-bs-target="#happyMomentCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="artists-section section-padding" id="section_3">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-12 text-center">
                            <h2 class="mb-4">Meet Panel Members</h2>
                        </div>
                        <!-- Panel Year Selector -->
                        <div class="col-12 text-center mb-4">
                            <div class="panel-year-selector">
                                <label for="panelYearSelect" class="form-label text-white fw-bold mb-2">View Panel by Year:</label>
                                <select id="panelYearSelect" class="form-select panel-year-dropdown">
                                    <option value="current">Current Panel (2024-2025)</option>
                                    <option value="panel_23_24">2023–2024</option>
                                    <option value="panel_22_23">2022–2023</option>
                                    <option value="panel_21_22">2021–2022</option>
                                    <option value="panel_20_21">2020–2021</option>
                                    <option value="panel_19_20">2019–2020</option>
                                </select>
                            </div>
                        </div>

                        <!-- Previous Panels Modal -->
                        <div class="modal fade" id="previousPanelsModal" tabindex="-1" aria-labelledby="previousPanelsModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content" style="background: rgba(30,30,40,0.97); color: #fff; border-radius: 18px;">
                              <div class="modal-header" style="border-bottom: 1px solid #f3d35c;">
                                <h4 class="modal-title" id="previousPanelsModalLabel">Previous Panel Members & Secretaries (2021-2024)</h4>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <!-- Tabs for years -->
                                <ul class="nav nav-tabs mb-4" id="panelYearTabs" role="tablist">
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="panel2024-tab" data-bs-toggle="tab" data-bs-target="#panel2024" type="button" role="tab" aria-controls="panel2024" aria-selected="true">2024</button>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="panel2023-tab" data-bs-toggle="tab" data-bs-target="#panel2023" type="button" role="tab" aria-controls="panel2023" aria-selected="false">2023</button>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="panel2022-tab" data-bs-toggle="tab" data-bs-target="#panel2022" type="button" role="tab" aria-controls="panel2022" aria-selected="false">2022</button>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="panel2021-tab" data-bs-toggle="tab" data-bs-target="#panel2021" type="button" role="tab" aria-controls="panel2021" aria-selected="false">2021</button>
                                  </li>
                                </ul>
                                <div class="tab-content" id="panelYearTabsContent">
                                  <!-- 2024 Panel -->
                                  <div class="tab-pane fade show active" id="panel2024" role="tabpanel" aria-labelledby="panel2024-tab">
                                    <h5 class="mb-3">Panel Members 2024</h5>
                                    <div class="row g-3 mb-4">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Panel/aparup.jpg" class="img-fluid" alt="aparup.jpg"><div class="name">aparup</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Panel/mamun.jpg" class="img-fluid" alt="mamun.jpg"><div class="name">mamun</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Panel/nafisa.jpg" class="img-fluid" alt="nafisa.jpg"><div class="name">nafisa</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Panel/zia.jpg" class="img-fluid" alt="zia.jpg"><div class="name">zia</div></div></div>
                                    </div>
                                    <h5 class="mb-3">Secretaries 2024</h5>
                                    <div class="row g-3">
                                                                          <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Kazi_Tawsiat_Binte_Ehsan.jpg" class="img-fluid" alt="Kazi_Tawsiat_Binte_Ehsan.jpg"><div class="name">Kazi Tawsiat Binte Ehsan</div></div></div>
                                    <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Avibadhan_Das.jpg" class="img-fluid" alt="Avibadhan_Das.jpg"><div class="name">Avibadhan Das</div></div></div>
                                    <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Diana_Halder_Momo.jpg" class="img-fluid" alt="Diana_Halder_Momo.jpg"><div class="name">Diana Halder Momo</div></div></div>
                                    <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Fabiha_Bushra_Ali.jpg" class="img-fluid" alt="Fabiha_Bushra_Ali.jpg"><div class="name">Fabiha Bushra Ali</div></div></div>
                                    <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Habib_Hasan.jpg" class="img-fluid" alt="Habib_Hasan.jpg"><div class="name">Habib Hasan</div></div></div>
                                                                              <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Jareen_Tasnim_Bushra.jpg" class="img-fluid" alt="Jareen_Tasnim_Bushra.jpg"><div class="name">Jareen Tasnim Bushra</div></div></div>
                                        <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Jubair_Rahman.jpg" class="img-fluid" alt="Jubair_Rahman.jpg"><div class="name">Jubair Rahman</div></div></div>
                                        <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Khaled_Bin_Taher.jpg" class="img-fluid" alt="Khaled_Bin_Taher.jpg"><div class="name">Khaled Bin Taher</div></div></div>
                                        <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Lalon.jpg" class="img-fluid" alt="Lalon.jpg"><div class="name">Lalon</div></div></div>
                                        <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Lawrence_Clifford_Gomes.jpg" class="img-fluid" alt="Lawrence_Clifford_Gomes.jpg"><div class="name">Lawrence Clifford Gomes</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/MD_Sadman_Safin_Oasif.jpg" class="img-fluid" alt="MD_Sadman_Safin_Oasif.jpg"><div class="name">MD Sadman Safin Oasif</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Mahamudul_Hossain_Jisun.jpg" class="img-fluid" alt="Mahamudul_Hossain_Jisun.jpg"><div class="name">Mahamudul Hossain Jisun</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Maria_Kamal_Katha.jpg" class="img-fluid" alt="Maria_Kamal_Katha.jpg"><div class="name">Maria Kamal Katha</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Md_Ahnaf_Farhan.jpg" class="img-fluid" alt="Md_Ahnaf_Farhan.jpg"><div class="name">Md Ahnaf Farhan</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Nafisa_Islam.jpg" class="img-fluid" alt="Nafisa_Islam.jpg"><div class="name">Nafisa Islam</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Nilonjana_Mojumder.jpg" class="img-fluid" alt="Nilonjana_Mojumder.jpg"><div class="name">Nilonjana Mojumder</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Rubaba_Khijir_Nusheen.jpg" class="img-fluid" alt="Rubaba_Khijir_Nusheen.jpg"><div class="name">Rubaba Khijir Nusheen</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Rudra_Mathew_Gomes.jpg" class="img-fluid" alt="Rudra_Mathew_Gomes.jpg"><div class="name">Rudra Mathew Gomes</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Showmik_Safi.jpg" class="img-fluid" alt="Showmik_Safi.jpg"><div class="name">Showmik Safi</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Shreya_Sangbriti.jpg" class="img-fluid" alt="Shreya_Sangbriti.jpg"><div class="name">Shreya Sangbriti</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Syed_Ariful_Islam_Aowan.jpg" class="img-fluid" alt="Syed_Ariful_Islam_Aowan.jpg"><div class="name">Syed Ariful Islam Aowan</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Tamejul_habib.jpg" class="img-fluid" alt="Tamejul_habib.jpg"><div class="name">Tamejul habib</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/Tasnimul_Hasan.jpg" class="img-fluid" alt="Tasnimul_Hasan.jpg"><div class="name">Tasnimul Hasan</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/reshad.jpg" class="img-fluid" alt="reshad.jpg"><div class="name">reshad</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_24_25/Secreteries/rudian.jpg" class="img-fluid" alt="rudian.jpg"><div class="name">rudian</div></div></div>
                                    </div>
                                  </div>
                                  <!-- 2023 Panel -->
                                  <div class="tab-pane fade" id="panel2023" role="tabpanel" aria-labelledby="panel2023-tab">
                                    <h5 class="mb-3">Panel Members 2023</h5>
                                    <div class="row g-3 mb-4">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Panel/Tamima Diba (Financial Secretary).jpg" class="img-fluid" alt="Tamima Diba (Financial Secretary).jpg"><div class="name">Tamima Diba (Financial Secretary)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Panel/Musharrat Quazi (GS).jpg" class="img-fluid" alt="Musharrat Quazi (GS).jpg"><div class="name">Musharrat Quazi (GS)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Panel/Nawshaba Maniza Riddhi (VP).jpg" class="img-fluid" alt="Nawshaba Maniza Riddhi (VP).jpg"><div class="name">Nawshaba Maniza Riddhi (VP)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Panel/Nashib Siam (President).jpg" class="img-fluid" alt="Nashib Siam (President).jpg"><div class="name">Nashib Siam (President)</div></div></div>
                                    </div>
                                    <h5 class="mb-3">Secretaries 2023</h5>
                                    <div class="row g-3">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Admin/Affan Adid (Admin).jpg" class="img-fluid" alt="Affan Adid (Admin).jpg"><div class="name">Affan Adid (Admin)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Admin/Shadman Sakib (Admin).jpg" class="img-fluid" alt="Shadman Sakib (Admin).jpg"><div class="name">Shadman Sakib (Admin)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Creative/4395462e-d871-4a7f-9f3f-89f8e94b34b7.jpg" class="img-fluid" alt="4395462e-d871-4a7f-9f3f-89f8e94b34b7.jpg"><div class="name">4395462e-d871-4a7f-9f3f-89f8e94b34b7</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Creative/Humayra (Creative).jpg" class="img-fluid" alt="Humayra (Creative).jpg"><div class="name">Humayra (Creative)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Events/dac0edcf-0586-4919-8c22-7a87e1a92030.jpg" class="img-fluid" alt="dac0edcf-0586-4919-8c22-7a87e1a92030.jpg"><div class="name">dac0edcf-0586-4919-8c22-7a87e1a92030</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Events/Mamun Abdullah ( Events).jpg" class="img-fluid" alt="Mamun Abdullah ( Events).jpg"><div class="name">Mamun Abdullah ( Events)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Events/Towkeer Zia ( Events).jpg" class="img-fluid" alt="Towkeer Zia ( Events).jpg"><div class="name">Towkeer Zia ( Events)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Finance/5874f814-dd73-4448-b09f-d6ef2b6e1686.jpg" class="img-fluid" alt="5874f814-dd73-4448-b09f-d6ef2b6e1686.jpg"><div class="name">5874f814-dd73-4448-b09f-d6ef2b6e1686</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Marketing/1e8229c5-7857-48d3-a808-50cf92f442ca (1).jpg" class="img-fluid" alt="1e8229c5-7857-48d3-a808-50cf92f442ca (1).jpg"><div class="name">1e8229c5-7857-48d3-a808-50cf92f442ca (1)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Marketing/42ad3eee-370d-4b85-b04c-f149107b014e.jpg" class="img-fluid" alt="42ad3eee-370d-4b85-b04c-f149107b014e.jpg"><div class="name">42ad3eee-370d-4b85-b04c-f149107b014e</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Marketing/Ayam (Marketing).jpg" class="img-fluid" alt="Ayam (Marketing).jpg"><div class="name">Ayam (Marketing)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/6a2c9948-7284-4455-87ea-e78640578bc1.jpg" class="img-fluid" alt="6a2c9948-7284-4455-87ea-e78640578bc1.jpg"><div class="name">6a2c9948-7284-4455-87ea-e78640578bc1</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/Performance.jpg" class="img-fluid" alt="Performance.jpg"><div class="name">Performance</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/e5f566ce-830a-48e0-92e9-fd097f3ea3c6.jpeg" class="img-fluid" alt="e5f566ce-830a-48e0-92e9-fd097f3ea3c6.jpeg"><div class="name">e5f566ce-830a-48e0-92e9-fd097f3ea3c6</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/e46329e0-5f2e-4921-8f9b-94326e0a79e3.jpeg" class="img-fluid" alt="e46329e0-5f2e-4921-8f9b-94326e0a79e3.jpeg"><div class="name">e46329e0-5f2e-4921-8f9b-94326e0a79e3</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/55e82bf0-d43f-4014-874a-ba5e84824334 (1).jpeg" class="img-fluid" alt="55e82bf0-d43f-4014-874a-ba5e84824334 (1).jpeg"><div class="name">55e82bf0-d43f-4014-874a-ba5e84824334 (1)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/Taufiq (Performance).jpg" class="img-fluid" alt="Taufiq (Performance).jpg"><div class="name">Taufiq (Performance)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/Priyata (Performance).jpg" class="img-fluid" alt="Priyata (Performance).jpg"><div class="name">Priyata (Performance)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/Aparup Chy (Performance).jpg" class="img-fluid" alt="Aparup Chy (Performance).jpg"><div class="name">Aparup Chy (Performance)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/Performance/Nafisa Noor (Performance).jpg" class="img-fluid" alt="Nafisa Noor (Performance).jpg"><div class="name">Nafisa Noor (Performance)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/PR/e335550a-5587-4fce-98ec-e8a348a349ed.jpg" class="img-fluid" alt="e335550a-5587-4fce-98ec-e8a348a349ed.jpg"><div class="name">e335550a-5587-4fce-98ec-e8a348a349ed</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/PR/Jisa (PR).jpg" class="img-fluid" alt="Jisa (PR).jpg"><div class="name">Jisa (PR)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/RD/Sadid ( Rd).jpg" class="img-fluid" alt="Sadid ( Rd).jpg"><div class="name">Sadid ( Rd)</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_23_24/Secreteries/RD/Zaarin RD.jpg" class="img-fluid" alt="Zaarin RD.jpg"><div class="name">Zaarin RD</div></div></div>
                                    </div>
                                  </div>
                                  <!-- 2022 Panel -->
                                  <div class="tab-pane fade" id="panel2022" role="tabpanel" aria-labelledby="panel2022-tab">
                                    <h5 class="mb-3">Panel Members 2022</h5>
                                    <div class="row g-3 mb-4">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Panel/Copy of 487208029_4090148864590979_892055582219564636_n.jpg" class="img-fluid" alt="Copy of 487208029_4090148864590979_892055582219564636_n.jpg"><div class="name">Copy of 487208029_4090148864590979_892055582219564636_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Panel/515437567_1952489408489387_1315940866281760937_n.jpg" class="img-fluid" alt="515437567_1952489408489387_1315940866281760937_n.jpg"><div class="name">515437567_1952489408489387_1315940866281760937_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Panel/489790186_122124644834718672_952791625051701298_n.jpg" class="img-fluid" alt="489790186_122124644834718672_952791625051701298_n.jpg"><div class="name">489790186_122124644834718672_952791625051701298_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Panel/454317040_10225148019343878_7594567972609169834_n.jpg" class="img-fluid" alt="454317040_10225148019343878_7594567972609169834_n.jpg"><div class="name">454317040_10225148019343878_7594567972609169834_n</div></div></div>
                                    </div>
                                    <h5 class="mb-3">Secretaries 2022</h5>
                                    <div class="row g-3">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Creative/510740052_2819515388251792_6735446540811213763_n.jpg" class="img-fluid" alt="510740052_2819515388251792_6735446540811213763_n.jpg"><div class="name">510740052_2819515388251792_6735446540811213763_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Creative/490736541_1977798036086773_3000833491529229081_n.jpg" class="img-fluid" alt="490736541_1977798036086773_3000833491529229081_n.jpg"><div class="name">490736541_1977798036086773_3000833491529229081_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Events/489028088_4153227901564307_6545631968149006210_n.jpg" class="img-fluid" alt="489028088_4153227901564307_6545631968149006210_n.jpg"><div class="name">489028088_4153227901564307_6545631968149006210_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Events/480995672_2660218930991191_8235151262219661059_n.jpg" class="img-fluid" alt="480995672_2660218930991191_8235151262219661059_n.jpg"><div class="name">480995672_2660218930991191_8235151262219661059_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Hr/472370182_1149915786477951_6056069315363886104_n.jpg" class="img-fluid" alt="472370182_1149915786477951_6056069315363886104_n.jpg"><div class="name">472370182_1149915786477951_6056069315363886104_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Hr/501121457_1886902955416097_5984553724984653614_n.jpg" class="img-fluid" alt="501121457_1886902955416097_5984553724984653614_n.jpg"><div class="name">501121457_1886902955416097_5984553724984653614_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Miap/471131890_2674590862712918_1095176438308251710_n.jpg" class="img-fluid" alt="471131890_2674590862712918_1095176438308251710_n.jpg"><div class="name">471131890_2674590862712918_1095176438308251710_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Miap/476928218_4138321956397849_5349156780703278381_n.jpg" class="img-fluid" alt="476928218_4138321956397849_5349156780703278381_n.jpg"><div class="name">476928218_4138321956397849_5349156780703278381_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Miap/125222830_1519850231543985_6741215565114242602_n.jpg" class="img-fluid" alt="125222830_1519850231543985_6741215565114242602_n.jpg"><div class="name">125222830_1519850231543985_6741215565114242602_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /494677560_3567139276915951_500501141503205430_n.jpg" class="img-fluid" alt="494677560_3567139276915951_500501141503205430_n.jpg"><div class="name">494677560_3567139276915951_500501141503205430_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /693523ae-d6a7-4ecf-9019-7dbeffe40d5b.jpg" class="img-fluid" alt="693523ae-d6a7-4ecf-9019-7dbeffe40d5b.jpg"><div class="name">693523ae-d6a7-4ecf-9019-7dbeffe40d5b</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /493336238_3882899925356160_2734435013679817532_n.jpg" class="img-fluid" alt="493336238_3882899925356160_2734435013679817532_n.jpg"><div class="name">493336238_3882899925356160_2734435013679817532_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /473764764_1254931698931721_8299944785147251773_n.jpg" class="img-fluid" alt="473764764_1254931698931721_8299944785147251773_n.jpg"><div class="name">473764764_1254931698931721_8299944785147251773_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /486450617_1919606155485104_6809497294325923308_n.jpg" class="img-fluid" alt="486450617_1919606155485104_6809497294325923308_n.jpg"><div class="name">486450617_1919606155485104_6809497294325923308_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Performance /497848042_3934565303471734_3886354026328395083_n.jpg" class="img-fluid" alt="497848042_3934565303471734_3886354026328395083_n.jpg"><div class="name">497848042_3934565303471734_3886354026328395083_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /pr/444153012_3785493371736142_462752584676454365_n.jpg" class="img-fluid" alt="444153012_3785493371736142_462752584676454365_n.jpg"><div class="name">444153012_3785493371736142_462752584676454365_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /pr/480423169_3848521462027733_2531340458933374732_n.jpg" class="img-fluid" alt="480423169_3848521462027733_2531340458933374732_n.jpg"><div class="name">480423169_3848521462027733_2531340458933374732_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /pr/477762506_1629168234369158_7049362160222121335_n.jpg" class="img-fluid" alt="477762506_1629168234369158_7049362160222121335_n.jpg"><div class="name">477762506_1629168234369158_7049362160222121335_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_22_23/Secreteries /Rd/476365485_1667974633790431_7689234733040607911_n.jpg" class="img-fluid" alt="476365485_1667974633790431_7689234733040607911_n.jpg"><div class="name">476365485_1667974633790431_7689234733040607911_n</div></div></div>
                                    </div>
                                  </div>
                                  <!-- 2021 Panel -->
                                  <div class="tab-pane fade" id="panel2021" role="tabpanel" aria-labelledby="panel2021-tab">
                                    <h5 class="mb-3">Panel Members 2021</h5>
                                    <div class="row g-3 mb-4">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Panel/487048639_3105546046276958_9148728155394135784_n.jpg" class="img-fluid" alt="487048639_3105546046276958_9148728155394135784_n.jpg"><div class="name">487048639_3105546046276958_9148728155394135784_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Panel/183667601_2775574012753527_371707836928886195_n.jpg" class="img-fluid" alt="183667601_2775574012753527_371707836928886195_n.jpg"><div class="name">183667601_2775574012753527_371707836928886195_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Panel/476383228_3256767717796347_285371354205090761_n.jpg" class="img-fluid" alt="476383228_3256767717796347_285371354205090761_n.jpg"><div class="name">476383228_3256767717796347_285371354205090761_n</div></div></div>
                                    </div>
                                    <h5 class="mb-3">Secretaries 2021</h5>
                                    <div class="row g-3">
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /admin/476856981_4123432817892541_1624224823209103418_n.jpg" class="img-fluid" alt="476856981_4123432817892541_1624224823209103418_n.jpg"><div class="name">476856981_4123432817892541_1624224823209103418_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /admin/480205108_1673069036614324_5079654607934815247_n.jpg" class="img-fluid" alt="480205108_1673069036614324_5079654607934815247_n.jpg"><div class="name">480205108_1673069036614324_5079654607934815247_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /creative/69861786_510323629778636_5845785793657831424_n.jpg" class="img-fluid" alt="69861786_510323629778636_5845785793657831424_n.jpg"><div class="name">69861786_510323629778636_5845785793657831424_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /creative/471658768_1664068401128077_7406622409763109517_n.jpg" class="img-fluid" alt="471658768_1664068401128077_7406622409763109517_n.jpg"><div class="name">471658768_1664068401128077_7406622409763109517_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /events/504868796_4146322538979491_918509307535544619_n.jpg" class="img-fluid" alt="504868796_4146322538979491_918509307535544619_n.jpg"><div class="name">504868796_4146322538979491_918509307535544619_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /events/454317040_10225148019343878_7594567972609169834_n.jpg" class="img-fluid" alt="454317040_10225148019343878_7594567972609169834_n.jpg"><div class="name">454317040_10225148019343878_7594567972609169834_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /fin/500367999_3581840292112516_2140517489434280250_n.jpg" class="img-fluid" alt="500367999_3581840292112516_2140517489434280250_n.jpg"><div class="name">500367999_3581840292112516_2140517489434280250_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /fin/Copy of 487208029_4090148864590979_892055582219564636_n.jpg" class="img-fluid" alt="Copy of 487208029_4090148864590979_892055582219564636_n.jpg"><div class="name">Copy of 487208029_4090148864590979_892055582219564636_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /hr/465844472_2640701509435187_7978154684435128783_n.jpg" class="img-fluid" alt="465844472_2640701509435187_7978154684435128783_n.jpg"><div class="name">465844472_2640701509435187_7978154684435128783_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /hr/515437567_1952489408489387_1315940866281760937_n.jpg" class="img-fluid" alt="515437567_1952489408489387_1315940866281760937_n.jpg"><div class="name">515437567_1952489408489387_1315940866281760937_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /miap/354961206_6671265479584724_7746041063655378665_n.jpg" class="img-fluid" alt="354961206_6671265479584724_7746041063655378665_n.jpg"><div class="name">354961206_6671265479584724_7746041063655378665_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /miap/124971238_3388976321209438_2585177128912475862_n.jpg" class="img-fluid" alt="124971238_3388976321209438_2585177128912475862_n.jpg"><div class="name">124971238_3388976321209438_2585177128912475862_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /pr/469337595_3924168784509776_3814304461961048715_n.jpg" class="img-fluid" alt="469337595_3924168784509776_3814304461961048715_n.jpg"><div class="name">469337595_3924168784509776_3814304461961048715_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /pr/483106530_4026994964252647_8895841218075580060_n.jpg" class="img-fluid" alt="483106530_4026994964252647_8895841218075580060_n.jpg"><div class="name">483106530_4026994964252647_8895841218075580060_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /rd/470235244_2667326150106056_3872053460634156449_n.jpg" class="img-fluid" alt="470235244_2667326150106056_3872053460634156449_n.jpg"><div class="name">470235244_2667326150106056_3872053460634156449_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /rd/128351021_228325362052613_4561984735401676055_n.jpg" class="img-fluid" alt="128351021_228325362052613_4561984735401676055_n.jpg"><div class="name">128351021_228325362052613_4561984735401676055_n</div></div></div>
                                      <div class="col-6 col-md-3 text-center"><div class="panel-card"><img src="images/Panel_21_22/Secreteries /rd/475195409_1168331491303047_2401447768072024913_n.jpg" class="img-fluid" alt="475195409_1168331491303047_2401447768072024913_n.jpg"><div class="name">475195409_1168331491303047_2401447768072024913_n</div></div></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer" style="border-top: 1px solid #f3d35c;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Previous Panels Modal -->

                        <!-- Panel Content Area -->
                        <div class="panel-content-area col-12">
                            <!-- Loading Spinner -->
                            <div class="panel-loading" id="panelLoading" style="display: none;">
                                <div class="spinner"></div>
                            </div>
                            
                            <!-- Panel Members Container -->
                            <div class="panel-members-container" id="panelMembersContainer">
                                <div class="row justify-content-center panel-members-grid">
                                    <!-- Current Panel Members (2024-2025) -->
                                    <div class="col-lg-5 col-12 mb-4">
                                        <div class="artists-thumb">
                                            <div class="artists-image-wrap">
                                                <img src="images/Panel_24_25/Panel/aparup.jpg"
                                                    class="artists-image img-fluid">
                                            </div>

                                            <div class="artists-hover">
                                                <p>
                                                    <strong>Name:</strong>
                                                    Aparup Chowdhury
                                                </p>

                                                <p>
                                                    <strong>Position:</strong>
                                                    President
                                                </p>

                                                <hr>

                                                <p class="mb-0">
                                                    <strong>Facebook:</strong>
                                                    <a
                                                        href="https://www.facebook.com/aparup.chy.77">Aparup
                                                        Chowdhury</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-12 mb-4">
                                        <div class="artists-thumb">
                                            <div class="artists-image-wrap">
                                                <img src="images/Panel_24_25/Panel/nafisa.jpg"
                                                    class="artists-image img-fluid">
                                            </div>

                                            <div class="artists-hover">
                                                <p>
                                                    <strong>Name:</strong>
                                                    Nafisa Noor
                                                </p>

                                                <p>
                                                    <strong>Position:</strong>
                                                    General Secretary
                                                </p>

                                                <hr>

                                                <p class="mb-0">
                                                    <strong>Facebook:</strong>
                                                    <a
                                                        href="https://www.facebook.com/nafisa.noor.57685">Nafisa
                                                        Noor</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-12 mb-4">
                                        <div class="artists-thumb">
                                            <div class="artists-image-wrap">
                                                <img src="images/Panel_24_25/Panel/zia.jpg"
                                                    class="artists-image img-fluid">
                                            </div>

                                            <div class="artists-hover">
                                                <p>
                                                    <strong>Name:</strong>
                                                    Towkeer Mohammad Zia
                                                </p>

                                                <p>
                                                    <strong>Position:</strong>
                                                    Joint Secretary
                                                </p>

                                                <hr>

                                                <p class="mb-0">
                                                    <strong>Facebook:</strong>
                                                    <a
                                                        href="https://www.facebook.com/towkeer.mohammad.zia.2024">Towkeer
                                                        Mohammad Zia</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-12 mb-4">
                                        <div class="artists-thumb">
                                            <div class="artists-image-wrap">
                                                <img src="images/Panel_24_25/Panel/mamun.jpg"
                                                    class="artists-image img-fluid">
                                            </div>

                                            <div class="artists-hover">
                                                <p>
                                                    <strong>Name:</strong>
                                                    Mamun Abdullah
                                                </p>

                                                <p>
                                                    <strong>Position:</strong>
                                                    Vice President
                                                </p>

                                                <hr>

                                                <p class="mb-0">
                                                    <strong>Facebook:</strong>
                                                    <a
                                                        href="https://www.facebook.com/aam099">Mamun
                                                        Abdullah</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- done -->

            <!-- SB Members Section -->
            <section class="sb-section" id="section_4">
                <div class="container">
                    <h2 class="sb-section-title" id="sbSectionTitle">Meet Our SB Members</h2>

                    <!-- SB Members Container -->
                    <div class="sb-members-container" id="sbMembersContainer">
                        <div class="album-cover">
                            <div class="swiper sb-swiper" id="sbSwiper">
                                <div class="swiper-wrapper" id="sbSwiperWrapper">
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/rudian.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/rudian.borneel"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Rudian Borneel</span>
                                        <span class="position">Secretary of
                                            Human Resource</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/MD_Sadman_Safin_Oasif.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/profile.php?id=100008597416622"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">MD Sadman Safin
                                            Oasif</span>
                                        <span class="position">Secretary of
                                            Human Resource</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img
                                        src="images/Panel_24_25/Secreteries/Mahamudul_Hossain_Jisun.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/foggy.winter.007"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Mahamudul Hossain
                                            Jisun</span>
                                        <span class="position">Secretary of
                                            Event Management & Logistics</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Nilonjana_Mojumder.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/arushi.lien"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Nilonjana
                                            Mojumder</span>
                                        <span class="position">Secretary of
                                            Event Management & Logistics</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Showmik_Safi.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/profile.php?id=100067106982577"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Showmik Safi</span>
                                        <span class="position">Secretary of
                                            Event Management & Logistics</span>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Tamejul_habib.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/INCcharlie19"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Tamejul Habib</span>
                                        <span class="position">Secretary of
                                            Finance</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Nafisa_Islam.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/nafisaislamahona"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Nafisa Islam</span>
                                        <span class="position">Secretary of
                                            Creative</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Shreya_Sangbriti.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://web.facebook.com/shreyasangbriti#"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Shreya
                                            Sangbriti</span>
                                        <span class="position">Secretary of
                                            Creative</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Avibadhan_Das.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/avibadhan.dasarno"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Avibadhan Das</span>
                                        <span class="position">Secretary of
                                            Performance (Music)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Lalon.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/andalib.mostafa.1"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Lalon Mostafa</span>
                                        <span class="position">Secretary of
                                            Performance (Music)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Rudra_Mathew_Gomes.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/henry.ribeiro.33"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Rudra Mathew
                                            Gomes</span>
                                        <span class="position">Secretary of
                                            Performance (Music)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img
                                        src="images/Panel_24_25/Secreteries/Syed_Ariful_Islam_Aowan.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/syedariful.aowan"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Syed Ariful Islam
                                            Aowan</span>
                                        <span class="position">Secretary of
                                            Performance (Music)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Rubaba_Khijir_Nusheen.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/rubaba.nusheen"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Rubaba Khijir
                                            Nusheen</span>
                                        <span class="position">Secretary of
                                            Performance (Dance)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Maria_Kamal_Katha.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/maria.kamal.katha"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Maria Kamal
                                            Katha</span>
                                        <span class="position">Secretary of
                                            Performance (Dance)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Diana_Halder_Momo.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/diana.momo.334"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Diana Halder
                                            Momo</span>
                                        <span class="position">Secretary of
                                            Performance (Dance)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Jubair_Rahman.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/jubair.rahman.765511"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Jubair Rahman</span>
                                        <span class="position">Secretary of
                                            Performance (Dance)</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Fabiha_Bushra_Ali.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/fabooshu"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Fabiha Bushra
                                            Ali</span>
                                        <span class="position">Secretary of
                                            Public Relation</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Md_Ahnaf_Farhan.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/ahnaf.farhan.1"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Md Ahnaf
                                            Farhan</span>
                                        <span class="position">Secretary of
                                            Public Relation</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Khaled_Bin_Taher.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/Khaled.tahsin18"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Khaled Bin
                                            Taher</span>
                                        <span class="position">Secretary of
                                            Public Relation</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img
                                        src="images/Panel_24_25/Secreteries/Kazi_Tawsiat_Binte_Ehsan.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/kazitawsiat.binteehsan"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Kazi Tawsiat Binte Ehsan</span>
                                        <span class="position">Secretary of
                                            Admin</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Jareen_Tasnim_Bushra.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/buushraaaaaa21"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Jareen Tasnim
                                            Bushra</span>
                                        <span class="position">Secretary of
                                            Research & Development</span>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img src="images/Panel_24_25/Secreteries/Tasnimul_Hasan.jpg"
                                        onerror="this.src='images/placeholder.png'" />
                                    <div class="overlay">
                                        <a
                                            href="https://www.facebook.com/buushraaaaaa21"
                                            target="_blank">
                                            <ion-icon name="logo-facebook"
                                                style="color: #1877f2"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="member-name">
                                        <span class="name">Tasnimul Hasan</span>
                                        <span class="position">Secretary of
                                            Research & Development</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Swiper Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="schedule-section section-padding" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-12 text-center">

                            <div class="event-schedule-container">
                                <div class="event-schedule-header">Event
                                    Schedule</div>
                                <div class="event-cards-grid">
                                    <!-- Card 1 -->
                                    <div class="event-card" onclick="window.location.href='past_events.html#pop-night'" style="cursor: pointer;">
                                        <div class="event-card-bg"
                                            style="background-image: url('images/slide2.jpg');"></div>
                                        <div class="event-card-content">
                                            <span class="event-icon"><i
                                                    class="fa-solid fa-music"></i></span>
                                            <div class="event-title">Pop
                                                Night</div>
                                            <div class="event-time">Wed, 5:00 -
                                                7:00 PM</div>
                                            <div class="event-by">By Adele</div>
                                        </div>
                                    </div>
                                    <!-- Card 2 -->
                                    <div class="event-card" onclick="window.location.href='past_events.html#rock-roll'" style="cursor: pointer;">
                                        <div class="event-card-bg"
                                            style="background-image: url('images/slide3.jpg');"></div>
                                        <div class="event-card-content">
                                            <span class="event-icon"><i
                                                    class="fa-solid fa-guitar"></i></span>
                                            <div class="event-title">Rock &
                                                Roll</div>
                                            <div class="event-time">Fri, 7:00 -
                                                11:00 PM</div>
                                            <div class="event-by">By
                                                Rihana</div>
                                        </div>
                                    </div>
                                    <!-- Card 3 -->
                                    <div class="event-card" onclick="window.location.href='past_events.html#dj-night'" style="cursor: pointer;">
                                        <div class="event-card-bg"
                                            style="background-image: url('images/slide4.jpg');"></div>
                                        <div class="event-card-content">
                                            <span class="event-icon"><i
                                                    class="fa-solid fa-headphones"></i></span>
                                            <div class="event-title">DJ
                                                Night</div>
                                            <div class="event-time">Thu, 6:30 -
                                                9:30 PM</div>
                                            <div class="event-by">By
                                                Rihana</div>
                                        </div>
                                    </div>
                                    <!-- Card 4 -->
                                    <div class="event-card" onclick="window.location.href='past_events.html#country-music'" style="cursor: pointer;">
                                        <div class="event-card-bg"
                                            style="background-image: url('images/slide5.jpg');"></div>
                                        <div class="event-card-content">
                                            <span class="event-icon"><i
                                                    class="fa-solid fa-microphone"></i></span>
                                            <div class="event-title">Country
                                                Music</div>
                                            <div class="event-time">Sat, 4:30 -
                                                7:30 PM</div>
                                            <div class="event-by">By
                                                Rihana</div>
                                        </div>
                                    </div>
                                    <!-- Card 5 -->
                                    <div class="event-card" onclick="window.location.href='past_events.html#free-styles'" style="cursor: pointer;">
                                        <div class="event-card-bg"
                                            style="background-image: url('images/slide1.jpg');"></div>
                                        <div class="event-card-content">
                                            <span class="event-icon"><i
                                                    class="fa-solid fa-star"></i></span>
                                            <div class="event-title">Free
                                                Styles</div>
                                            <div class="event-time">Sat, 6:00 -
                                                10:00 PM</div>
                                            <div class="event-by">By
                                                Members</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="contact-section section-padding" id="footer">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
                            <h2 class="text-center mb-4 signup-title">Sign Up</h2>

                            <nav class="d-flex justify-content-center">
                                <div
                                    class="nav nav-tabs align-items-baseline justify-content-center"
                                    id="nav-tab" role="tablist">
                                    <button class="nav-link active signup-tab"
                                        id="nav-ContactForm-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#nav-ContactForm"
                                        type="button" role="tab"
                                        aria-controls="nav-ContactForm"
                                        aria-selected="true">
                                        <h5>Sign Up Form</h5>
                                    </button>
                                    <button class="nav-link login-tab"
                                        id="nav-LoginForm-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#nav-LoginForm"
                                        type="button" role="tab"
                                        aria-controls="nav-LoginForm"
                                        aria-selected="false">
                                        <h5>Login</h5>
                                    </button>
                                    <button class="nav-link maps-tab"
                                        id="nav-ContactMap-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#nav-ContactMap"
                                        type="button" role="tab"
                                        aria-controls="nav-ContactMap"
                                        aria-selected="false">
                                        <h5>Google Maps</h5>
                                    </button>
                                </div>
                            </nav>

                            <div class="tab-content shadow-lg mt-5 signup-container"
                                id="nav-tabContent">
                                <!-- Floating particles for signup section -->
                                <div class="signup-particles" id="signupParticles"></div>
                                
                                <div class="tab-pane fade show active"
                                    id="nav-ContactForm" role="tabpanel"
                                    aria-labelledby="nav-ContactForm-tab">
                                    <form onsubmit="handleSubmit(event)"
                                        id="signup-form"
                                        name="signupForm"
                                        class="custom-form contact-form mb-5 mb-lg-0"
                                        action="#"
                                        method="POST" role="form">
                                        <div class="contact-form-body">
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="text"
                                                        name="signup-name"
                                                        id="signup-name"
                                                        class="form-control"
                                                        placeholder="Full Name"
                                                        required>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="text"
                                                        name="signup-id"
                                                        id="signup-id"
                                                        class="form-control"
                                                        placeholder="University ID"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="email"
                                                        name="signup-main-email"
                                                        id="signup-main-email"
                                                        class="form-control"
                                                        placeholder="Main Email Address"
                                                        required>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="email"
                                                        name="signup-gsuite-email"
                                                        id="signup-gsuite-email"
                                                        class="form-control"
                                                        placeholder="GSuite Email (if available)">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="password"
                                                        name="signup-password"
                                                        id="signup-password"
                                                        class="form-control"
                                                        placeholder="Password"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="text"
                                                        name="signup-department"
                                                        id="signup-department"
                                                        class="form-control"
                                                        placeholder="Department"
                                                        required>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="tel"
                                                        name="signup-phone"
                                                        id="signup-phone"
                                                        class="form-control"
                                                        placeholder="Phone Number"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <select
                                                        name="signup-semester"
                                                        id="signup-semester"
                                                        class="form-control"
                                                        required>
                                                        <option value>Current
                                                            Semester</option>
                                                        <option
                                                            value="1st">1st</option>
                                                        <option
                                                            value="2nd">2nd</option>
                                                        <option
                                                            value="3rd">3rd</option>
                                                        <option
                                                            value="4th">4th</option>
                                                        <option
                                                            value="5th">5th</option>
                                                        <option
                                                            value="6th">6th</option>
                                                        <option
                                                            value="7th">7th</option>
                                                        <option
                                                            value="8th">8th</option>
                                                        <option
                                                            value="9th">9th</option>
                                                        <option
                                                            value="10th+">10th
                                                            or above</option>
                                                    </select>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <select name="signup-gender"
                                                        id="signup-gender"
                                                        class="form-control"
                                                        required>
                                                        <option
                                                            value>Gender</option>
                                                        <option
                                                            value="Male">Male</option>
                                                        <option
                                                            value="Female">Female</option>
                                                        <option
                                                            value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="date"
                                                        name="signup-dob"
                                                        id="signup-dob"
                                                        class="form-control"
                                                        placeholder="Date of Birth"
                                                        required>
                                                </div>
                                                <div
                                                    class="col-lg-6 col-md-6 col-12 mb-3">
                                                    <input type="url"
                                                        name="signup-facebook"
                                                        id="signup-facebook"
                                                        class="form-control"
                                                        placeholder="Facebook Profile URL">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 mb-3">
                                                    <label
                                                        class="form-label">Membership
                                                        Status:</label>
                                                    <div
                                                        class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="membership-status"
                                                            id="status-new"
                                                            value="New Member"
                                                            required>
                                                        <label
                                                            class="form-check-label"
                                                            for="status-new">New
                                                            Member</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="membership-status"
                                                            id="status-current"
                                                            value="Current Member">
                                                        <label
                                                            class="form-check-label"
                                                            for="status-current">Current
                                                            Member</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="membership-status"
                                                            id="status-previous"
                                                            value="Previous Member">
                                                        <label
                                                            class="form-check-label"
                                                            for="status-previous">Previous
                                                            Member</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Event Category:</label>
                                                    <select name="signup-event-category"
                                                        id="signup-event-category"
                                                        class="form-control"
                                                        required>
                                                        <option value="">Select Event Category</option>
                                                        <option value="Music">🎵 Music</option>
                                                        <option value="Dance">💃 Dance</option>
                                                        <option value="Drama">🎭 Drama</option>
                                                        <option value="Art">🎨 Art</option>
                                                        <option value="Poetry">📝 Poetry</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <textarea name="signup-motivation"
                                                rows="3"
                                                class="form-control mt-3"
                                                id="signup-motivation"
                                                placeholder="Why do you want to join? (Motivation)"
                                                required></textarea>
                                            <div class="form-check mt-3 mb-3">
                                                <input class="form-check-input"
                                                    type="checkbox" value="1"
                                                    id="signup-terms" required>
                                                <label class="form-check-label"
                                                    for="signup-terms">
                                                    I agree to the terms and
                                                    conditions
                                                </label>
                                            </div>
                                            <div
                                                class="col-lg-4 col-md-10 col-8 mx-auto">
                                                <button type="submit"
                                                    class="form-control">Sign
                                                    Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="nav-LoginForm"
                                    role="tabpanel"
                                    aria-labelledby="nav-LoginForm-tab">
                                    <div class="admin-check-container text-center">
                                        <div class="admin-check-icon mb-4">
                                            <i class="fas fa-user-shield" style="font-size: 3.5rem; color: white;"></i>
                                        </div>
                                        <h3 class="admin-check-title mb-4">Admin Access</h3>
                                        <p class="admin-check-description mb-4">Are you an administrator of the Cultural Club?</p>
                                        
                                        <div class="admin-options">
                                            <button type="button" class="btn btn-success btn-lg me-3" onclick="checkAdminStatus(true)">
                                                <i class="fas fa-check me-2"></i>Yes, I am an Admin
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-lg" onclick="checkAdminStatus(false)">
                                                <i class="fas fa-times me-2"></i>No, I'm not
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-ContactMap"
                                    role="tabpanel"
                                    aria-labelledby="nav-ContactMap-tab">
                                    <iframe class="google-map"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1100.1434944730236!2d90.42450743390042!3d23.77246450986446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7715a40c603%3A0xec01cd75f33139f5!2sBRAC%20University!5e1!3m2!1sen!2sbd!4v1745998853929!5m2!1sen!2sbd"
                                        width="100%" height="450"
                                        style="border:0;" allowfullscreen
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer" id="footer">
            <div class="site-footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <h2
                                class="text-white mb-lg-0 d-flex align-items-center">
                                <img src="images/logo.png" alt="Club Logo"
                                    style="height: 1.5em; margin-right: 0.5em; vertical-align: middle;">
                                BUCuC
                            </h2>
                        </div>

                        <div
                            class="col-lg-6 col-12 d-flex justify-content-lg-end align-items-center">
                            <ul
                                class="social-icon d-flex justify-content-lg-end ms-lg-auto">
                                <li class="social-icon-item">
                                    <a href="https://www.facebook.com/bucuc"
                                        class="social-icon-link"
                                        target="_blank">
                                        <span class="bi-facebook"></span>
                                    </a>
                                </li>
                                <li class="social-icon-item">
                                    <a
                                        href="https://www.youtube.com/@bracuniversityculturalclub717"
                                        class="social-icon-link"
                                        target="_blank">
                                        <span class="bi-youtube"></span>
                                    </a>
                                </li>
                                <li class="social-icon-item">
                                    <a
                                        href="https://www.instagram.com/bucuclive/"
                                        class="social-icon-link"
                                        target="_blank">
                                        <span class="bi-instagram"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-4 pb-2">
                        <h5 class="site-footer-title mb-3">Links</h5>

                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="#section_1"
                                    class="site-footer-link click-scroll">Home</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#section_2"
                                    class="site-footer-link click-scroll">About</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#section_3"
                                    class="site-footer-link click-scroll">BUCuC
                                    Panel</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#section_5"
                                    class="site-footer-link click-scroll">Schedule</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#section_4"
                                    class="site-footer-link click-scroll">Sb
                                    Members</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#very-bottom"
                                    class="site-footer-link click-scroll">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                        <h5 class="site-footer-title mb-3">Have a question?</h5>

                        <p class="text-white d-flex mb-1">
                            <a href="tel:+8801601946311"
                                class="site-footer-link">
                                01601946311
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <a href="mailto:hr.bucuc@gmail.com"
                                class="site-footer-link">
                                hr.bucuc@gmail.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 col-11 mb-4 mb-lg-0 mb-md-0">
                        <h5 class="site-footer-title mb-3">Location</h5>

                        <p class="text-white d-flex mt-3 mb-2">
                            Kha 224 Pragati Sarani, Merul Badda , Dhaka 1212</p>

                        <a class="link-fx-1 color-contrast-higher mt-3"
                            href="https://www.google.com/maps/place/BRAC+University/@23.7724645,90.4245074,17z"
                            target="_blank">
                            <span>Our Maps</span>
                            <svg class="icon" viewBox="0 0 32 32"
                                aria-hidden="true"><g fill="none"
                                    stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round"><circle cx="16"
                                        cy="16" r="15.5"></circle><line x1="10"
                                        y1="18" x2="16" y2="12"></line><line
                                        x1="16" y1="12" x2="22"
                                        y2="18"></line></g></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-12 mt-5">
                            <p class="copyright-text">Copyright © 2036 BUCuC
                                Company</p>
                        </div>

                        <div class="col-lg-8 col-12 mt-lg-5">
                            <ul class="site-footer-links">
                                <li class="site-footer-link-item">
                                    <a href="#" class="site-footer-link">Terms
                                        &amp; Conditions</a>
                                </li>

                                <li class="site-footer-link-item">
                                    <a href="#" class="site-footer-link">Privacy
                                        Policy</a>
                                </li>

                                <li class="site-footer-link-item">
                                    <a href="#" class="site-footer-link">Your
                                        Feedback</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="very-bottom"></div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/apps-script.js"></script>

        <!-- Swiper JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            // Initialize Swiper after DOM is fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Function to determine if loop should be enabled
                function shouldEnableLoop() {
                    const slides = document.querySelectorAll('.sb-swiper .swiper-slide');
                    console.log('SB Slides found:', slides.length);
                    return slides.length > 5; // Enable loop only if more than 5 slides
                }
                
                // Count slides before initializing
                const totalSlides = document.querySelectorAll('.sb-swiper .swiper-slide').length;
                console.log('Total SB slides detected:', totalSlides);
                
                window.sbSwiper = new Swiper('.sb-swiper', {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    loop: totalSlides > 5, // Enable loop if more than 5 slides
                    loopAdditionalSlides: 2,
                    initialSlide: 0,
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 120,
                        modifier: 1,
                        slideShadows: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    autoplay: false,
                    // Responsive breakpoints:
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 5,
                            spaceBetween: 56,
                        },
                    },
                    on: {
                        init: function() {
                            console.log('SB Swiper initialized with', this.slides.length, 'slides');
                        },
                        slideChange: function() {
                            console.log('Slide changed to:', this.activeIndex);
                        }
                    }
                });
                
                // Setup intersection observer for autoplay
                let autoplayStarted = false;
                const sbSection = document.getElementById('section_4');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !autoplayStarted && window.sbSwiper) {
                            try {
                                window.sbSwiper.slideToLoop(0, 0); // Go to first slide instantly
                                if (window.sbSwiper.autoplay) {
                                    window.sbSwiper.autoplay.start();
                                }
                                autoplayStarted = true;
                                console.log('SB Swiper autoplay started');
                            } catch (error) {
                                console.error('Error starting autoplay:', error);
                            }
                        }
                    });
                }, { threshold: 0.7 });

                if (sbSection) {
                    observer.observe(sbSection);
                }
            });
        </script>

        <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
                navbar.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
                navbar.classList.remove('scrolled');
            }
        });
        </script>

        <script>
        window.addEventListener('DOMContentLoaded', function() {
            window.scrollTo(0, 0);
            // Also clear any hash in the URL
            if (window.location.hash) {
                history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        });
        </script>

        <script>

            function handleSubmit(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(document.forms["signupForm"]);
                
                // Validate password length
                const password = formData.get('signup-password');
                if (password.length < 6) {
                    showCustomNotification('Password must be at least 6 characters long', 'error');
                    return;
                }
                
                // Validate email format
                const email = formData.get('signup-main-email');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    showCustomNotification('Please enter a valid email address', 'error');
                    return;
                }
                
                // Submit to our PHP handler
                fetch('Action/signup_handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showCustomNotification(data.message, 'success');
                        // Reset form
                        document.forms["signupForm"].reset();
                        // Redirect to login after 2 seconds
                        setTimeout(() => {
                            window.location.href = 'login.php';
                        }, 2000);
                    } else {
                        showCustomNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showCustomNotification('Registration failed. Please try again.', 'error');
                });
            }
            
        </script>

        <script>
        // Admin Check Function
        function checkAdminStatus(isAdmin) {
            if (isAdmin) {
                // Redirect to admin login page
                window.location.href = 'admin-login.php';
            } else {
                // Show notification and redirect to header
                showCustomNotification('Sorry, you are not an admin', 'warning');
                setTimeout(() => {
                    window.location.href = 'index.php#section_1';
                }, 2000);
            }
        }
        
        // Custom notification function
        function showCustomNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `custom-notification ${type}`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Hide and remove notification
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
        
        function showInlineMessage(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.left = '50%';
            alertDiv.style.transform = 'translateX(-50%)';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.minWidth = '300px';
            alertDiv.style.textAlign = 'center';

            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(document.getElementById('login-form'));
            formData.append('action', 'login');

            fetch('https://script.google.com/macros/s/AKfycbz-FKOQ8Uu32cr4q6DUv2--KtAqJHMdGWUcEknJAV9mJh6TlB-JYrw1mmG2myiTar6C/exec', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    showInlineMessage('Logged in as ' + response.name, 'success');
                } else {
                    showInlineMessage('Invalid email or password', 'danger');
                }
            })
            .catch(err => {
                showInlineMessage('There was an error. Please try again.', 'danger');
            });
        });
        </script>
        <script>
        // Mobile Sidebar Toggle Script (right sidebar, close button)
        (function() {
          var sidebar = document.getElementById('mobileSidebar');
          var overlay = document.getElementById('mobileSidebarOverlay');
          var toggleBtn = document.getElementById('sidebarToggle');
          function toggleSidebar() {
            var isOpen = sidebar.classList.toggle('open');
            overlay.classList.toggle('open', isOpen);
            toggleBtn.classList.toggle('open', isOpen);
          }
          if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
          if (overlay) overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            toggleBtn.classList.remove('open');
          });
        })();
        </script>
        <style>
        @media (max-width: 768px) {
          .sidebar-toggle-btn {
            width: 44px;
            background: #f8f8fc;
            border: none;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 1200;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          .sidebar-toggle-bar {
            position: absolute;
            left: 50%;
            width: 24px;
            height: 3.5px;
            background: #555;
            border-radius: 2.5px;
            transition: all 0.3s cubic-bezier(.4,2,.6,1);
            transform: translateX(-50%) translateY(0);
          }
          .sidebar-toggle-bar:nth-child(1) {
            top: 14px;
          }
          .sidebar-toggle-bar:nth-child(2) {
            top: 20px;
          }
          .sidebar-toggle-bar:nth-child(3) {
            top: 26px;
          }
          .sidebar-toggle-btn.open .sidebar-toggle-bar:nth-child(1) {
            top: 20px;
            transform: translateX(-50%) rotate(45deg);
          }
          .sidebar-toggle-btn.open .sidebar-toggle-bar:nth-child(2) {
            opacity: 0;
          }
          .sidebar-toggle-btn.open .sidebar-toggle-bar:nth-child(3) {
            top: 20px;
            transform: translateX(-50%) rotate(-45deg);
          }
        }
        </style>
        <style>
        /* Modern Premium Modal Styles for Previous Panels */
        #previousPanelsModal .modal-content {
          background: linear-gradient(135deg, #0a1931 0%, #1a2639 100%);
          color: #222;
          border-radius: 22px;
          box-shadow: 0 8px 40px 0 #000a, 0 0 0 4px #ffd70033;
          border: none;
        }
        #previousPanelsModal .modal-header, #previousPanelsModal .modal-footer {
          border: none;
          background: transparent;
        }
        #previousPanelsModal .modal-title {
          font-weight: 700;
          letter-spacing: 1px;
          color: #ffd700;
        }
        #previousPanelsModal .nav-tabs {
          border-bottom: 2.5px solid #ffd700;
          justify-content: center;
        }
        #previousPanelsModal .nav-tabs .nav-link {
          color: #0a1931;
          background: none;
          border: none;
          font-weight: 600;
          font-size: 1.1em;
          margin: 0 8px;
          border-radius: 8px 8px 0 0;
          transition: background 0.2s, color 0.2s;
        }
        #previousPanelsModal .nav-tabs .nav-link.active {
          background: #ffd700;
          color: #0a1931;
          box-shadow: 0 2px 8px #ffd70044;
        }
        #previousPanelsModal .tab-pane {
          padding: 8px 0 0 0;
        }
        #previousPanelsModal .row.g-3 {
          margin-bottom: 0.5rem;
        }
        #previousPanelsModal .panel-card {
          background: #fff;
          border-radius: 16px;
          box-shadow: 0 2px 12px #0002, 0 0 0 2px #ffd70033;
          padding: 18px 8px 10px 8px;
          margin-bottom: 12px;
          transition: transform 0.18s, box-shadow 0.18s;
          border: 2px solid #ffd700;
          position: relative;
          min-height: 210px;
        }
        #previousPanelsModal .panel-card:hover {
          transform: translateY(-4px) scale(1.03);
          box-shadow: 0 8px 32px #ffd70033, 0 0 0 4px #ffd70055;
          z-index: 2;
        }
        #previousPanelsModal .panel-card img {
          border-radius: 12px;
          border: 2.5px solid #ffd700;
          box-shadow: 0 2px 12px #0004;
          margin-bottom: 8px;
          max-height: 120px;
          object-fit: cover;
          background: #fff;
        }
        #previousPanelsModal .panel-card .name {
          font-weight: 600;
          font-size: 1.08em;
          color: #0a1931;
        }
        #previousPanelsModal .panel-card .position {
          font-size: 0.98em;
          color: #1a2639;
          opacity: 0.85;
        }
        #previousPanelsModal .tab-pane h5 {
          color: #ffd700;
          font-weight: 600;
          margin-bottom: 1.1rem;
          margin-top: 0.5rem;
        }
        @media (max-width: 768px) {
          #previousPanelsModal .panel-card img {
            max-height: 80px;
          }
          #previousPanelsModal .panel-card {
            min-height: 140px;
            padding: 10px 2px 6px 2px;
          }
        }
                </style>
        
        <script>
        // Enhanced Signup Form Interactions and Floating Particles
        document.addEventListener('DOMContentLoaded', function() {
            // Create floating particles for signup section
            function createSignupParticles() {
                const particlesContainer = document.getElementById('signupParticles');
                if (!particlesContainer) return;
                
                const particleCount = 25;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'signup-particle';
                    
                    // Random size between 3px and 8px
                    const size = Math.random() * 5 + 3;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 8 + 's';
                    particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                    
                    particlesContainer.appendChild(particle);
                }
            }
            
            // Enhanced form field interactions
            function enhanceFormFields() {
                const formFields = document.querySelectorAll('.form-control');
                
                formFields.forEach(field => {
                    // Add focus effects
                    field.addEventListener('focus', function() {
                        this.parentElement.style.transform = 'translateY(-2px)';
                        this.parentElement.style.boxShadow = '0 5px 20px rgba(231, 111, 44, 0.2)';
                    });
                    
                    field.addEventListener('blur', function() {
                        this.parentElement.style.transform = 'translateY(0)';
                        this.parentElement.style.boxShadow = 'none';
                    });
                    
                    // Add typing animation
                    field.addEventListener('input', function() {
                        if (this.value.length > 0) {
                            this.style.borderColor = '#e76f2c';
                        } else {
                            this.style.borderColor = 'rgba(231, 111, 44, 0.1)';
                        }
                    });
                });
            }
            
            // Enhanced tab switching with animations
            function enhanceTabSwitching() {
                const tabs = document.querySelectorAll('.nav-link');
                
                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        // Add click animation
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    });
                });
            }
            
            // Enhanced submit button
            function enhanceSubmitButton() {
                const submitBtn = document.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.addEventListener('click', function(e) {
                        // Add loading state
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing Up...';
                        this.disabled = true;
                        
                        // Simulate loading (remove this in production)
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }, 2000);
                    });
                }
            }
            
            // Enhanced radio button interactions
            function enhanceRadioButtons() {
                const radioButtons = document.querySelectorAll('.form-check-input[type="radio"]');
                
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        // Add selection animation
                        this.parentElement.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            this.parentElement.style.transform = 'scale(1)';
                        }, 200);
                    });
                });
            }
            
            // Enhanced checkbox interactions
            function enhanceCheckbox() {
                const checkbox = document.querySelector('#signup-terms');
                if (checkbox) {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            this.parentElement.style.color = '#e76f2c';
                            this.parentElement.style.fontWeight = '600';
                        } else {
                            this.parentElement.style.color = '#333';
                            this.parentElement.style.fontWeight = '400';
                        }
                    });
                }
            }
            
            // Initialize all enhancements
            createSignupParticles();
            enhanceFormFields();
            enhanceTabSwitching();
            enhanceSubmitButton();
            enhanceRadioButtons();
            enhanceCheckbox();
            
            // Add scroll animation for signup section
            const signupSection = document.querySelector('.contact-section');
            if (signupSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                });
                
                signupSection.style.opacity = '0';
                signupSection.style.transform = 'translateY(30px)';
                signupSection.style.transition = 'all 0.8s ease';
                
                observer.observe(signupSection);
            }
        });
        </script>
        
        <!-- Panel Year Dropdown JavaScript -->
        <script>
document.addEventListener('DOMContentLoaded', function() {
    // Correct panel-year-dropdown identifier
    const dropdown = document.getElementById('panelYearSelect');
    if (!dropdown) {
        console.error('Panel year dropdown not found!');
        return;
    }
     // Map dropdown values to panel data keys
     const panelDataKeys = {
         'current': '2024',
         'panel_23_24': '2023',
         'panel_22_23': '2022',
         'panel_21_22': '2021',
         'panel_20_21': '2020',
         'panel_19_20': '2019'
     };

    // Panel data mapping
    const panelData = {
        '2024': {
            panelMembers: [
                {
                    name: 'Aparup Chowdhury',
                    image: 'images/Panel_24_25/Panel/aparup.jpg'
                },
                {
                    name: 'Mamun Abdullah',
                    image: 'images/Panel_24_25/Panel/mamun.jpg'
                },
                {
                    name: 'Nafisa Noor',
                    image: 'images/Panel_24_25/Panel/nafisa.jpg'
                },
                {
                    name: 'Towkeer Mohammad Zia',
                    image: 'images/Panel_24_25/Panel/zia.jpg'
                }
            ],
            sbMembers: [
                {
                    name: 'Kazi Tawsiat Binte Ehsan',
                    image: 'images/Panel_24_25/Secreteries/Kazi_Tawsiat_Binte_Ehsan.jpg'
                },
                {
                    name: 'Avibadhan Das',
                    image: 'images/Panel_24_25/Secreteries/Avibadhan_Das.jpg'
                },
                {
                    name: 'Diana Halder Momo',
                    image: 'images/Panel_24_25/Secreteries/Diana_Halder_Momo.jpg'
                },
                {
                    name: 'Fabiha Bushra Ali',
                    image: 'images/Panel_24_25/Secreteries/Fabiha_Bushra_Ali.jpg'
                },
                {
                    name: 'Habib Hasan',
                    image: 'images/Panel_24_25/Secreteries/Habib_Hasan.jpg'
                },
                {
                    name: 'Jareen Tasnim Bushra',
                    image: 'images/Panel_24_25/Secreteries/Jareen_Tasnim_Bushra.jpg'
                },
                {
                    name: 'Jubair Rahman',
                    image: 'images/Panel_24_25/Secreteries/Jubair_Rahman.jpg'
                },
                {
                    name: 'Rudian Ahmed',
                    image: 'images/Panel_24_25/Secreteries/rudian.jpg'
                }
            ]
        },
        '2023': {
          panelMembers: [
              {
                  name: 'Nashib Siam',
                  image: 'images/Panel_23_24/Panels/Nashib Siam (President).jpg'
              },
              {
                  name: 'Nawshaba Maniza Riddhi',
                  image: 'images/Panel_23_24/Panels/Nawshaba Maniza Riddhi (VP).jpg'
              },
              {
                  name: 'Musharrat Quazi',
                  image: 'images/Panel_23_24/Panels/Musharrat Quazi (GS).jpg'
              },
              {
                  name: 'Tamima Diba',
                  image: 'images/Panel_23_24/Panels/Tamima Diba (Financial Secretary).jpg'
              }
          ],
          sbMembers: [
              {
                  name: 'Affan Adid',
                  image: 'images/Panel_23_24/Secretary/Admin/Affan Adid (Admin).jpg'
              },
              {
                  name: 'Shadman Sakib',
                  image: 'images/Panel_23_24/Secretary/Admin/Shadman Sakib (Admin).jpg'
              },
              {
                  name: 'Humayra',
                  image: 'images/Panel_23_24/Secretary/Creative/Humayra (Creative).jpg'
              },
              {
                  name: 'Mamun Abdullah',
                  image: 'images/Panel_23_24/Secretary/Events/Mamun Abdullah ( Events).jpg'
              },
              {
                  name: 'Towkeer Zia',
                  image: 'images/Panel_23_24/Secretary/Events/Towkeer Zia ( Events).jpg'
              },
              {
                  name: 'Ayam',
                  image: 'images/Panel_23_24/Secretary/Marketing/Ayam (Marketing).jpg'
              },
              {
                  name: 'Aparup Chowdhury',
                  image: 'images/Panel_23_24/Secretary/Performance/Aparup Chy (Performance).jpg'
              },
              {
                  name: 'Nafisa Noor',
                  image: 'images/Panel_23_24/Secretary/Performance/Nafisa Noor (Performance).jpg'
              },
              {
                  name: 'Priyata',
                  image: 'images/Panel_23_24/Secretary/Performance/Priyata (Performance).jpg'
              },
              {
                  name: 'Taufiq',
                  image: 'images/Panel_23_24/Secretary/Performance/Taufiq (Performance).jpg'
              },
              {
                  name: 'Jisa',
                  image: 'images/Panel_23_24/Secretary/PR/Jisa (PR).jpg'
              },
              {
                  name: 'Sadid',
                  image: 'images/Panel_23_24/Secretary/RD/Sadid ( Rd).jpg'
              },
              {
                  name: 'Zaarin',
                  image: 'images/Panel_23_24/Secretary/RD/Zaarin RD.jpg'
              }
          ]
        },
        '2022': {
            panelMembers: [
                {
                    name: 'John Doe',
                    image: 'images/Panel_22_23/Panel/454317040_10225148019343878_7594567972609169834_n.jpg'
                },
                {
                    name: 'Jane Smith',
                    image: 'images/Panel_22_23/Panel/489790186_122124644834718672_952791625051701298_n.jpg'
                },
                {
                    name: 'Alice Johnson',
                    image: 'images/Panel_22_23/Panel/515437567_1952489408489387_1315940866281760937_n.jpg'
                },
                {
                    name: 'Ethan Green',
                    image: 'images/Panel_22_23/Panel/Copy of 487208029_4090148864590979_892055582219564636_n.jpg'
                }
            ],
            sbMembers: [
                {
                    name: 'Bob Brown',
                    image: 'images/Panel_22_23/Secreteries/Creative/490736541_1977798036086773_3000833491529229081_n.jpg'
                },
                {
                    name: 'Charlie Davis',
                    image: 'images/Panel_22_23/Secreteries/Creative/510740052_2819515388251792_6735446540811213763_n.jpg'
                },
                {
                    name: 'Diana Prince',
                    image: 'images/Panel_22_23/Secreteries/Events/480995672_2660218930991191_8235151262219661059_n.jpg'
                },
                {
                    name: 'Eve Wilson',
                    image: 'images/Panel_22_23/Secreteries/Events/489028088_4153227901564307_6545631968149006210_n.jpg'
                },
                {
                    name: 'Frank Miller',
                    image: 'images/Panel_22_23/Secreteries/Hr/472370182_1149915786477951_6056069315363886104_n.jpg'
                },
                {
                    name: 'Grace Lee',
                    image: 'images/Panel_22_23/Secreteries/Performance/473764764_1254931698931721_8299944785147251773_n.jpg'
                },
                {
                    name: 'Henry Kim',
                    image: 'images/Panel_22_23/Secreteries/Performance/486450617_1919606155485104_6809497294325923308_n.jpg'
                },
                {
                    name: 'Ivy Chen (PR)',
                    image: 'images/Panel_22_23/Secreteries/pr/444153012_3785493371736142_462752584676454365_n.jpg'
                },
                {
                    name: 'Jack Ryan (PR)',
                    image: 'images/Panel_22_23/Secreteries/pr/477762506_1629168234369158_7049362160222121335_n.jpg'
                },
                {
                    name: 'Kelly Green (PR)',
                    image: 'images/Panel_22_23/Secreteries/pr/480423169_3848521462027733_2531340458933374732_n.jpg'
                },
                {
                    name: 'Liam Stone (HR)',
                    image: 'images/Panel_22_23/Secreteries/Hr/501121457_1886902955416097_5984553724984653614_n.jpg'
                },
                {
                    name: 'Maya Patel (Performance)',
                    image: 'images/Panel_22_23/Secreteries/Performance/493336238_3882899925356160_2734435013679817532_n.jpg'
                },
                {
                    name: 'Noah Davis (Performance)',
                    image: 'images/Panel_22_23/Secreteries/Performance/494677560_3567139276915951_500501141503205430_n.jpg'
                },
                {
                    name: 'Olivia Smith (Performance)',
                    image: 'images/Panel_22_23/Secreteries/Performance/497848042_3934565303471734_3886354026328395083_n.jpg'
                },
                {
                    name: 'Paul Wilson (Miap)',
                    image: 'images/Panel_22_23/Secreteries/Miap/125222830_1519850231543985_6741215565114242602_n.jpg'
                },
                {
                    name: 'Quinn Taylor (Miap)',
                    image: 'images/Panel_22_23/Secreteries/Miap/471131890_2674590862712918_1095176438308251710_n.jpg'
                },
                {
                    name: 'Ryan Mitchell (RD)',
                    image: 'images/Panel_22_23/Secreteries/Rd/476365485_1667974633790431_7689234733040607911_n.jpg'
                }
            ]
        },
        '2021': {
            panelMembers: [
                {
                    name: 'Sarah Connor',
                    image: 'images/Panel_21_22/Panel/183667601_2775574012753527_371707836928886195_n.jpg'
                },
                {
                    name: 'Kyle Reese',
                    image: 'images/Panel_21_22/Panel/476383228_3256767717796347_285371354205090761_n.jpg'
                },
                {
                    name: 'John Connor',
                    image: 'images/Panel_21_22/Panel/487048639_3105546046276958_9148728155394135784_n.jpg'
                }
            ],
            sbMembers: [
                {
                    name: 'Marcus Wright (Admin)',
                    image: 'images/Panel_21_22/Secreteries/admin/476856981_4123432817892541_1624224823209103418_n.jpg'
                },
                {
                    name: 'Kate Brewster (Admin)',
                    image: 'images/Panel_21_22/Secreteries/admin/480205108_1673069036614324_5079654607934815247_n.jpg'
                },
                {
                    name: 'Cameron Phillips (Creative)',
                    image: 'images/Panel_21_22/Secreteries/creative/471658768_1664068401128077_7406622409763109517_n.jpg'
                },
                {
                    name: 'Derek Reese (Creative)',
                    image: 'images/Panel_21_22/Secreteries/creative/69861786_510323629778636_5845785793657831424_n.jpg'
                },
                {
                    name: 'Jesse Flores (Events)',
                    image: 'images/Panel_21_22/Secreteries/events/454317040_10225148019343878_7594567972609169834_n.jpg'
                },
                {
                    name: 'Riley Dawson (Events)',
                    image: 'images/Panel_21_22/Secreteries/events/504868796_4146322538979491_918509307535544619_n.jpg'
                },
                {
                    name: 'Allison Young (Finance)',
                    image: 'images/Panel_21_22/Secreteries/fin/500367999_3581840292112516_2140517489434280250_n.jpg'
                },
                {
                    name: 'Charley Dixon (Finance)',
                    image: 'images/Panel_21_22/Secreteries/fin/Copy of 487208029_4090148864590979_892055582219564636_n.jpg'
                },
                {
                    name: 'Ellison (HR)',
                    image: 'images/Panel_21_22/Secreteries/hr/465844472_2640701509435187_7978154684435128783_n.jpg'
                },
                {
                    name: 'Weaver (HR)',
                    image: 'images/Panel_21_22/Secreteries/hr/515437567_1952489408489387_1315940866281760937_n.jpg'
                },
                {
                    name: 'Cromartie (Performance)',
                    image: 'images/Panel_21_22/Secreteries/perform/471993795_1815017182236611_7554013114998935137_n.jpg'
                },
                {
                    name: 'Bloodhound (Performance)',
                    image: 'images/Panel_21_22/Secreteries/perform/482211523_1686167981971096_5335183090621960727_n.jpg'
                },
                {
                    name: 'Shirley (Performance)',
                    image: 'images/Panel_21_22/Secreteries/perform/489790186_122124644834718672_952791625051701298_n.jpg'
                },
                {
                    name: 'Vick (PR)',
                    image: 'images/Panel_21_22/Secreteries/pr/469337595_3924168784509776_3814304461961048715_n.jpg'
                },
                {
                    name: 'Fischer (PR)',
                    image: 'images/Panel_21_22/Secreteries/pr/483106530_4026994964252647_8895841218075580060_n.jpg'
                },
                {
                    name: 'Tarissa (RD)',
                    image: 'images/Panel_21_22/Secreteries/rd/128351021_228325362052613_4561984735401676055_n.jpg'
                },
                {
                    name: 'Sarkissian (RD)',
                    image: 'images/Panel_21_22/Secreteries/rd/470235244_2667326150106056_3872053460634156449_n.jpg'
                },
                {
                    name: 'Goode (RD)',
                    image: 'images/Panel_21_22/Secreteries/rd/475195409_1168331491303047_2401447768072024913_n.jpg'
                }
            ]
        },
        '2020': {
            panelMembers: [
                {
                    name: 'Olivia Johnson',
                    image: 'images/Panel_20_21/Panel/36678546_2204235406270192_6483776573861265408_n.jpg'
                },
                {
                    name: 'William Smith',
                    image: 'images/Panel_20_21/Panel/475290115_1167819264687603_7003520522544381593_n.jpg'
                },
                {
                    name: 'Liam Anderson',
                    image: 'images/Panel_20_21/Panel/e592a15e-74a5-4ddf-b8f5-1b59aaf9a1c2.jpg'
                }
            ],
            sbMembers: [
                {
                    name: 'Emily Davis (Admin)',
                    image: 'images/Panel_20_21/ Secreteries/admin/476231235_1669345223653372_3407867370287020034_n.jpg'
                },
                {
                    name: 'James Brown (Creative)',
                    image: 'images/Panel_20_21/ Secreteries/creative/123926406_3095940650510775_7926925358628684138_n.jpg'
                },
                {
                    name: 'Mia Taylor (Creative)',
                    image: 'images/Panel_20_21/ Secreteries/creative/170745495_1691963967642284_8994484908450075508_n.jpg'
                },
                {
                    name: 'Noah Wilson (Creative)',
                    image: 'images/Panel_20_21/ Secreteries/creative/471644167_1812589182479411_6622247673044813939_n.jpg'
                },
                {
                    name: 'Ava Clark (Creative)',
                    image: 'images/Panel_20_21/ Secreteries/creative/474080428_2696073080564696_2146795879080295010_n.jpg'
                },
                {
                    name: 'Mason Lewis (Event)',
                    image: 'images/Panel_20_21/ Secreteries/event/464713040_2792921144222449_472237782771168408_n.jpg'
                },
                {
                    name: 'Isabella King (Event)',
                    image: 'images/Panel_20_21/ Secreteries/event/487048639_3105546046276958_9148728155394135784_n.jpg'
                },
                {
                    name: 'Lucas Anderson (Fin)',
                    image: 'images/Panel_20_21/ Secreteries/fin/454267796_3980565755491577_2874358743371603141_n.jpg'
                },
                {
                    name: 'Sophia Johnson (Fin)',
                    image: 'images/Panel_20_21/ Secreteries/fin/478539252_1178973010238895_1597122680872953961_n.jpg'
                },
                {
                    name: 'Ethan Martinez (HR)',
                    image: 'images/Panel_20_21/ Secreteries/hr/471583557_1813851939019802_6471843107952171020_n.jpg'
                },
                {
                    name: 'Amelia Harris (HR)',
                    image: 'images/Panel_20_21/ Secreteries/hr/516591792_3616860595277152_2104663676730743326_n.jpg'
                },
                {
                    name: 'Jacob Thompson (Miap)',
                    image: 'images/Panel_20_21/ Secreteries/miap/122523984_3062594330512074_6233342128374299200_n.jpg'
                },
                {
                    name: 'Charlotte White (Miap)',
                    image: 'images/Panel_20_21/ Secreteries/miap/66852429_2590974680915041_3878385481519464448_n.jpg'
                },
                {
                    name: 'Aiden Hall (Performance)',
                    image: 'images/Panel_20_21/ Secreteries/performance/469825113_2665417436963594_4201553788795341419_n (1).jpg'
                },
                {
                    name: 'Scarlett Allen (Performance)',
                    image: 'images/Panel_20_21/ Secreteries/performance/470238528_8671941482933412_630060569786467991_n.jpg'
                },
                {
                    name: 'Oliver Walker (Performance)',
                    image: 'images/Panel_20_21/ Secreteries/performance/471089076_2674572022714802_9175108119770714368_n.jpg'
                },
                {
                    name: 'Aubrey Scott (Performance)',
                    image: 'images/Panel_20_21/ Secreteries/performance/481067682_1684472232140671_6947975985174216726_n.jpg'
                },
                {
                    name: 'Sebastian Wright (Performance)',
                    image: 'images/Panel_20_21/ Secreteries/performance/494080037_3561101540853058_349832023715608278_n.jpg'
                },
                {
                    name: 'Zoey Baker (PR)',
                    image: 'images/Panel_20_21/ Secreteries/pr/146167213_3320171584754346_6243508639537889689_n.jpg'
                },
                {
                    name: 'Logan Phillips (PR)',
                    image: 'images/Panel_20_21/ Secreteries/pr/472235864_1815019072236422_1600336458892749079_n.jpg'
                },
                {
                    name: 'Lily Campbell (RD)',
                    image: 'images/Panel_20_21/ Secreteries/rd/404806443_7232254810171158_6587854861112096768_n.jpg'
                },
                {
                    name: 'Ben Mitchell (RD)',
                    image: 'images/Panel_20_21/ Secreteries/rd/468920931_8708487025893905_8271555839924075526_n.jpg'
                },
                {
                    name: 'Amelia Perez (RD)',
                    image: 'images/Panel_20_21/ Secreteries/rd/471327187_2679088635596474_4983230428569764592_n.jpg'
                },
                {
                    name: 'Jackson Garcia (RD)',
                    image: 'images/Panel_20_21/ Secreteries/rd/475698755_3192983197535274_4204510840426245112_n.jpg'
                                 }
             ]
         },
         '2019': {
             panelMembers: [
                 {
                     name: 'Murtafa Mridha',
                     image: 'images/Panel_19_20/Panel/Murtafa Mridha.jpg'
                 },
                 {
                     name: 'Samara Mehruz',
                     image: 'images/Panel_19_20/Panel/Samara Mehruz.jpg'
                 },
                 {
                     name: 'Shoaib Kamal',
                     image: 'images/Panel_19_20/Panel/Shoaib Kamal.jpg'
                 }
             ],
             sbMembers: [
                 {
                     name: 'Shahriar Nasif',
                     image: 'images/Panel_19_20/Secretaries/admin/Shahriar Nasif.jpg'
                 },
                 {
                     name: 'Sadia Ishtiaque',
                     image: 'images/Panel_19_20/Secretaries/creative/Sadia Ishtiaque.jpg'
                 },
                 {
                     name: 'Sayeda Lamia Tabassum',
                     image: 'images/Panel_19_20/Secretaries/creative/Sayeda Lamia Tabassum.jpg'
                 },
                 {
                     name: 'Iffat Binte Hakim',
                     image: 'images/Panel_19_20/Secretaries/creative/Iffat Binte Hakim.jpg'
                 },
                 {
                     name: 'Nafiz Noor',
                     image: 'images/Panel_19_20/Secretaries/event/Nafiz Noor.jpg'
                 },
                 {
                     name: 'Ishraq Avi',
                     image: 'images/Panel_19_20/Secretaries/fin/Ishraq Avi.jpg'
                 },
                 {
                     name: 'Zuairya Ashger Khan Nuha',
                     image: 'images/Panel_19_20/Secretaries/hr/Zuairya Ashger Khan Nuha.jpg'
                 },
                 {
                     name: 'Sadman Sakib Ayon',
                     image: 'images/Panel_19_20/Secretaries/miap/Sadman Sakib Ayon.jpg'
                 },
                 {
                     name: 'Aninda Nahiyan',
                     image: 'images/Panel_19_20/Secretaries/perfromance/Aninda Nahiyan.jpg'
                 },
                 {
                     name: 'Munirul Azam Zayed',
                     image: 'images/Panel_19_20/Secretaries/perfromance/Munirul Azam Zayed.jpg'
                 },
                 {
                     name: 'Saib Sizan',
                     image: 'images/Panel_19_20/Secretaries/perfromance/Saib Sizan.jpg'
                 },
                 {
                     name: 'George Gourab',
                     image: 'images/Panel_19_20/Secretaries/perfromance/George Gourab .jpg'
                 },
                 {
                     name: 'Sumit Dutta',
                     image: 'images/Panel_19_20/Secretaries/perfromance/Sumit Dutta.jpg'
                 },
                 {
                     name: 'Deepita Chakrabortty',
                     image: 'images/Panel_19_20/Secretaries/perfromance/Deepita Chakrabortty.jpg'
                 },
                 {
                     name: 'Pritam Chakraborty',
                     image: 'images/Panel_19_20/Secretaries/pr/Pritam Chakraborty.jpg'
                 },
                 {
                     name: 'Modhumonty Das',
                     image: 'images/Panel_19_20/Secretaries/pr/Modhumonty Das.jpg'
                 },
                 {
                     name: 'Afeed Nur',
                     image: 'images/Panel_19_20/Secretaries/rd/Afeed Nur.jpg'
                 },
                 {
                     name: 'Tanzim Ahmed Ornob',
                     image: 'images/Panel_19_20/Secretaries/rd/Tanzim Ahmed Ornob.jpg'
                 },
                 {
                     name: 'Kanika Saha',
                     image: 'images/Panel_19_20/Secretaries/rd/Kanika Saha.jpg'
                 },
                 {
                     name: 'Anika Anjum Sadia',
                     image: 'images/Panel_19_20/Secretaries/rd/Anika Anjum Sadia.jpg'
                 }
             ]
         }
     };

    // Handle dropdown change event
    dropdown.addEventListener('change', function() {
        const selectedYearKey = panelDataKeys[this.value];
        if (!selectedYearKey) {
            console.error('No data found for year:', this.value);
            return;
        }
        
        const data = panelData[selectedYearKey];
        updateMembers(data, selectedYearKey);
    });

console.log('JavaScript loaded correctly!');

async function updateMembers(data, yearKey = null) {
        const panelContainer = document.getElementById('panelMembersContainer');
        
        if (!panelContainer) {
            console.error('Panel container not found!');
            return;
        }
        
        console.log('Panel container found:', panelContainer);
        
        // Find the existing grid within the panel container
        const existingGrid = panelContainer.querySelector('.row.justify-content-center.panel-members-grid');
        console.log('Existing grid:', existingGrid);
        
        if (!existingGrid) {
            console.error('Panel grid not found! Container HTML:', panelContainer.innerHTML);
            return;
        }
        
        // Clear existing member cards
        existingGrid.innerHTML = '';
        
        // Add new panel members with full structure
        data.panelMembers.forEach((member, index) => {
            const memberDiv = document.createElement('div');
            
            // Adjust grid layout based on number of members
            const memberCount = data.panelMembers.length;
            if (memberCount === 4) {
                // For 4 members: 2 on top, 2 on bottom
                memberDiv.className = 'col-lg-6 col-12 mb-4';
            } else if (memberCount === 3) {
                // For 3 members: 2 on top, 1 centered below
                if (index < 2) {
                    memberDiv.className = 'col-lg-6 col-12 mb-4';
                } else {
                    memberDiv.className = 'col-lg-6 col-12 mb-4 mx-auto';
                }
            } else {
                // For other numbers: use original sizing
                memberDiv.className = 'col-lg-5 col-12 mb-4';
            }
            
            memberDiv.innerHTML = `
                <div class="artists-thumb">
                    <div class="artists-image-wrap">
                        <img src="${encodeURI(member.image)}" class="artists-image img-fluid" alt="${member.name}" 
                             onerror="this.src='images/placeholder.svg'; console.error('Failed to load image:', '${member.image}');" />
                    </div>
                    <div class="artists-hover">
                        <p><strong>Name:</strong> ${member.name}</p>
                        <p><strong>Position:</strong> Panel Member</p>
                        <hr>
                        <p class="mb-0"><strong>Facebook:</strong> <a href="#">${member.name}</a></p>
                    </div>
                </div>
            `;
            
            existingGrid.appendChild(memberDiv);
        });

        // Update SB members - try JSON data first, fallback to hardcoded data
        let sbMembersData = data.sbMembers; // Default to hardcoded data
        
        if (yearKey) {
            const jsonSBMembers = await loadSBMembersForYear(yearKey);
            if (jsonSBMembers) {
                sbMembersData = jsonSBMembers;
            }
        }
        
        const swiperWrapper = document.getElementById('sbSwiperWrapper');
        if (swiperWrapper && sbMembersData) {
            // Clear existing slides
            swiperWrapper.innerHTML = '';
            
            // Add new SB member slides
            sbMembersData.forEach(member => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                const facebookLink = member.facebook || '#';
                const memberName = member.name || 'Unknown';
                const memberPosition = member.position || 'Secretary';
                
                slide.innerHTML = `
                    <img src="${encodeURI(member.image)}" alt="${memberName}" onerror="this.src='images/placeholder.png'; console.error('Failed to load SB image:', '${member.image}');" />
                    <div class="overlay">
                        <a href="${facebookLink}" target="_blank">
                            <ion-icon name="logo-facebook" style="color: #1877f2"></ion-icon>
                        </a>
                    </div>
                    <div class="member-name">
                        <span class="name">${memberName}</span>
                        <span class="position">${memberPosition}</span>
                    </div>
                `;
                swiperWrapper.appendChild(slide);
            });
            
            // Reinitialize Swiper if it exists
            if (window.Swiper && window.sbSwiper) {
                // Destroy existing swiper
                window.sbSwiper.destroy(true, true);
                
                // Reinitialize with new slides
                const slideCount = sbMembersData.length;
                console.log('Reinitializing SB Swiper with', slideCount, 'slides for year:', yearKey);
                
                window.sbSwiper = new Swiper('.sb-swiper', {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    loop: slideCount > 5,
                    loopAdditionalSlides: 2,
                    initialSlide: 0,
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 120,
                        modifier: 1,
                        slideShadows: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        320: { slidesPerView: 1, spaceBetween: 10 },
                        480: { slidesPerView: 2, spaceBetween: 20 },
                        768: { slidesPerView: 3, spaceBetween: 30 },
                        1024: { slidesPerView: 5, spaceBetween: 56 },
                    },
                    on: {
                        init: function() {
                            console.log('SB Swiper reinitialized with', this.slides.length, 'slides');
                        }
                    }
                });
            }
        }
        
        console.log('Updated members for selected year:', data);
    }
    
// Enhanced updateMembers function to work with both hardcoded and JSON data
    async function loadSBMembersForYear(yearKey) {
        try {
            const response = await fetch("Api/members.json");
            const jsonData = await response.json();
            
            // Map yearKey to actual year number
            const yearMapping = {
                '2024': 2025, // Current year data
                '2023': 2024,
                '2022': 2023,
                '2021': 2022,
                '2020': 2021,
                '2019': 2020
            };
            
            const targetYear = yearMapping[yearKey];
            const yearData = jsonData.years.find(y => y.year === targetYear);
            
            if (yearData && yearData.secretaries) {
                console.log(`Found ${yearData.secretaries.length} secretaries for ${targetYear}`);
                return yearData.secretaries;
            } else {
                console.warn(`No JSON data found for year ${targetYear}, using hardcoded data`);
                return null;
            }
        } catch (error) {
            console.error('Error loading JSON data:', error);
            return null;
        }
    }

    // Initialize with current panel data (2024-2025)
    const initializeSBMembers = async () => {
        const currentData = panelData['2024'];
        if (currentData) {
            await updateMembers(currentData, '2024');
        }
    };

    // Call the initialization function
    initializeSBMembers();
        });
        </script>
        </body>
        </html>
