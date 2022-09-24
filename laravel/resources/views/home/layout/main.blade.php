<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>

    <!-- Header Start -->
    @include('home.layout.navbar')
    <!-- Header End -->

    @yield('content')

    {{-- my javascript --}}
    <script>
        // humberger menu
        const humberger = document.querySelector('header');
        const humbergerActive = document.querySelector('#humberger');
        const menuNav = document.querySelector('nav');

        humbergerActive.addEventListener('click', function() {
            humbergerActive.classList.toggle('humberger-active');
            menuNav.classList.toggle('hidden');
        });

        // navbar fixed
        const fixed = humberger.offsetTop;
        window.onscroll = function() {
            if (window.pageYOffset > fixed) {
                humberger.classList.add('nav-fixed');
            } else {
                humberger.classList.remove('nav-fixed');
            };
        }
    </script>
</body>

</html>
