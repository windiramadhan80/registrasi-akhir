<header class="w-full top-0 left-0 absolute flex px-4 py-4 items-center backdrop-blur-sm bg-white/80 shadow-md">
    <div class="container mx-auto md:px-10 flex">
        <div class="w-full lg:text-lg uppercase font-bold text-primary flex items-center">
            <a href="/">
                <img class="inline h-9 w-auto" src="/img/logocwe.png" alt=""><span class="ml-2">Kartu Tanda
                    Mahasiswa</span>
            </a>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="md:hidden" id="humberger">
                <span class="humberger-line origin-top-left transition duration-300"></span>
                <span class="humberger-line transition duration-300"></span>
                <span class="humberger-line origin-bottom-left transition duration-300"></span>
            </button>
        </div>
        <nav
            class="absolute md:relative hidden right-0 top-full w-[120px] z-10 bg-slate-100 px-4 py-2 rounded-lg shadow-lg text-sm md:w-full md:flex md:bg-transparent md:rounded-none md:shadow-none md:px-0">
            <ul class="md:flex md:w-full md:justify-end">
                <li class="mb-1 md:mx-4 md:font-semibold md:text-base"><a href="/"
                        class="hover:text-primary">Beranda</a></li>
                <li class="mb-1 md:mx-4 md:font-semibold md:text-base"><a href="/panduan"
                        class="hover:text-primary">Panduan</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="mb-1 md:ml-4 md:font-semibold md:text-base"><a href="{{ url('/redirects') }}"
                                class="hover:text-primary">KTM</a></li>
                    @else
                        <li class="mb-1 md:ml-4 md:font-semibold md:text-base"><a href="{{ route('login') }}"
                                class="hover:text-primary">Login</a></li>

                        @if (Route::has('register'))
                            <li class="mb-1 md:ml-4 md:font-semibold md:text-base"><a href="{{ route('register') }}"
                                    class="hover:text-primary">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </div>



</header>
