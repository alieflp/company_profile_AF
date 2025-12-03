<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name', 'Company Profile') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ \App\Models\Setting::get('meta_description', 'Professional IT solutions and web development services') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::get('meta_keywords', 'web development, IT solutions, digital transformation') }}">
    @vite('resources/css/app.css')
    <style>
        /* Alert Slide-in Animation */
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .animate-slide-in-right {
            animation: slideInRight 0.4s ease-out;
        }
        
        /* Auto-dismiss alert after 5 seconds */
        .auto-dismiss {
            animation: slideInRight 0.4s ease-out, fadeOut 0.4s ease-out 4.6s forwards;
        }
        
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }
        
        /* Scroll Animation Styles */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-animate.animate-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .scroll-animate-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-animate-left.animate-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-animate-right.animate-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-scale {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-animate-scale.animate-visible {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Stagger animation delays */
        .scroll-animate:nth-child(1) { transition-delay: 0.1s; }
        .scroll-animate:nth-child(2) { transition-delay: 0.2s; }
        .scroll-animate:nth-child(3) { transition-delay: 0.3s; }
        .scroll-animate:nth-child(4) { transition-delay: 0.4s; }
        .scroll-animate:nth-child(5) { transition-delay: 0.5s; }
        .scroll-animate:nth-child(6) { transition-delay: 0.6s; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased">
    {{-- NOTE: Pastikan named routes seperti `home`, `about`, `services.index.public`, dll sudah ditambahkan di routes/web.php --}}
    @include('partials.navbar')
    {{-- Toast Notifications --}}
    @include('partials.alerts')
    <main class="min-h-screen">
        @yield('content')
    </main>
    @include('partials.footer')
    
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.animate-slide-in-right');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.animation = 'slideInRight 0.4s ease-out, fadeOut 0.4s ease-out forwards';
                    setTimeout(() => alert.remove(), 400);
                }, 5000);
            });
        });
        
        // Intersection Observer for Scroll Animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-visible');
                    }
                });
            }, observerOptions);
            
            // Observe all elements with scroll animation classes
            const animateElements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale');
            animateElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>