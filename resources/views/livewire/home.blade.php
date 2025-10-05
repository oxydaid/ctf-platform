<div class="bg-gray-900">
    <style>
        /* CSS untuk animasi kursor berkedip */
        .blinking-cursor {
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {

            from,
            to {
                border-right-color: transparent;
            }

            50% {
                border-right-color: #4ade80;
                /* Warna hijau (green-400) */
            }
        }
    </style>
    <!-- Navbar -->
    <nav x-data="{ isOpen: false }" class="container p-6 mx-auto lg:flex lg:justify-between lg:items-center">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}">
                <span class="text-2xl font-bold text-white font-mono">CTF<span
                        class="text-green-400">Platform</span></span>
            </a>

            <!-- Tombol Hamburger untuk Mobile -->
            <div class="flex lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button"
                    class="text-gray-200 hover:text-green-400 focus:outline-none" aria-label="toggle menu">
                    <svg x-show="!isOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
                    <svg x-show="isOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-full']"
            class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-gray-900 lg:bg-transparent lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <a class="my-2 text-gray-200 transition-colors duration-300 transform hover:text-green-400 lg:mx-4 lg:my-0"
                    href="{{ route('home') }}">Home</a>
                <a class="my-2 text-gray-200 transition-colors duration-300 transform hover:text-green-400 lg:mx-4 lg:my-0"
                    href="{{ route('challenges') }}">Challenges</a>
                <a class="my-2 text-gray-200 transition-colors duration-300 transform hover:text-green-400 lg:mx-4 lg:my-0"
                    href="{{ route('leaderboards') }}">Leaderboards</a>
            </div>

            <div class="flex items-center mt-4 lg:mt-0 lg:ml-6">
                @auth
                    <a class="block px-5 py-2.5 text-sm font-medium tracking-wider text-center text-white capitalize transition-colors duration-300 transform bg-green-600 rounded-md hover:bg-green-500"
                        href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <div class="flex items-center space-x-2">
                        <a class="text-sm text-gray-200 hover:text-green-400" href="{{ route('login') }}">Login</a>
                        <a class="block px-5 py-2.5 text-sm font-medium tracking-wider text-center text-white capitalize transition-colors duration-300 transform bg-green-600 rounded-md hover:bg-green-500"
                            href="{{ route('register') }}">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container px-6 py-16 mx-auto text-center">
        <div class="max-w-3xl mx-auto" x-data="{
            fullText: '[ HACK THE SYSTEM ]',
            displayedText: '',
            init() {
                let i = 0;
                const interval = setInterval(() => {
                    if (i < this.fullText.length) {
                        this.displayedText += this.fullText.charAt(i);
                        i++;
                    } else {
                        clearInterval(interval);
                    }
                }, 150); // Kecepatan ketik (dalam milidetik)
            }
        }">
            {{-- Tulisan besar sekarang dikontrol oleh Alpine.js --}}
            <h1 class="text-4xl font-extrabold text-white lg:text-6xl font-mono">
                <span x-text="displayedText"></span>
                {{-- Kursor berkedip --}}
                <span class="blinking-cursor border-r-4 h-16"></span>
            </h1>

            <p class="mt-6 text-lg text-gray-300">
                Buktikan kemampuanmu. Pecahkan tantangan. Raih Peringkat Tertinggi.
            </p>
            <a href="{{ route('challenges') }}"
                class="inline-block px-8 py-3 mt-8 text-lg font-semibold leading-tight text-center text-white capitalize bg-green-600 rounded-lg hover:bg-green-500 focus:outline-none">
                Mulai Tantangan
            </a>
        </div>

        <div class="flex justify-center my-16">
            <img class="h-96 " src="{{ asset('img/hero.png') }}" />
        </div>
    </div>


    </section>
    <!-- BAGIAN FOOTER BARU DIMULAI DI SINI -->
    <footer class="bg-gray-900 border-t border-gray-800">
        <div class="container p-6 mx-auto">
            <div class="lg:flex">
                <div class="w-full -mx-6 lg:w-2/5">
                    <div class="px-6">
                        <a href="{{ route('home') }}">
                            <span class="text-2xl font-bold text-white font-mono">CTF<span
                                    class="text-green-400">Platform</span></span>
                        </a>

                        <p class="max-w-sm mt-2 text-gray-400">
                            Platform untuk mengasah kemampuan keamanan siber melalui tantangan Capture The Flag yang
                            interaktif.
                        </p>

                        <div class="flex mt-6 -mx-2">
                            {{-- Ganti '#' dengan link media sosial Anda --}}
                            <a href="#" class="mx-2 text-gray-400 transition-colors duration-300 hover:text-green-400"
                                aria-label="Github">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.026 2C7.13295 2 3.20312 5.93095 3.20312 10.8249C3.20312 14.7548 5.58733 18.0638 9.17133 19.4628C9.57933 19.5378 9.72133 19.2848 9.72133 19.0688C9.72133 18.8768 9.71533 18.3308 9.71133 17.6588C7.52133 18.1028 6.95333 16.6328 6.95333 16.6328C6.58633 15.7178 6.01633 15.4478 6.01633 15.4478C5.28233 14.9408 5.86033 14.9528 5.86033 14.9528C6.67833 15.0118 7.15233 15.7538 7.15233 15.7538C7.89633 17.0278 9.18933 16.6498 9.72233 16.3988C9.79533 15.8258 10.0383 15.4478 10.2913 15.2258C8.31833 15.0008 6.22233 14.2348 6.22233 10.4288C6.22233 9.38985 6.59633 8.52585 7.18233 7.84885C7.09133 7.62385 6.73433 6.64385 7.27233 5.38885C7.27233 5.38885 8.01033 5.14885 9.71233 6.31585C10.4183 6.12085 11.1783 6.02285 11.9333 6.01985C12.6883 6.02285 13.4483 6.12085 14.1553 6.31585C15.8573 5.14885 16.5953 5.38885 16.5953 5.38885C17.1333 6.64385 16.7763 7.62385 16.6853 7.84885C17.2713 8.52585 17.6453 9.38985 17.6453 10.4288C17.6453 14.2428 15.5483 15.0008 13.5733 15.2258C13.9013 15.5098 14.1483 16.0358 14.1483 16.8588C14.1483 18.0138 14.1373 18.9248 14.1373 19.0688C14.1373 19.2858 14.2783 19.5418 14.6883 19.4618C18.2653 18.0608 20.6483 14.7538 20.6483 10.8249C20.6483 5.93095 16.7183 2 11.8253 2H12.026Z">
                                    </path>
                                </svg>
                            </a>

                            <a href="#" class="mx-2 text-gray-400 transition-colors duration-300 hover:text-green-400"
                                aria-label="Twitter">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.643 4.937C22.825 5.312 21.942 5.562 21.008 5.687C21.942 5.125 22.673 4.25 23.022 3.25C22.14 3.75 21.18 4.125 20.165 4.312C19.333 3.437 18.156 2.875 16.846 2.875C14.318 2.875 12.253 4.937 12.253 7.468C12.253 7.812 12.29 8.125 12.365 8.437C8.134 8.25 4.313 6.125 1.756 3.125C1.352 3.812 1.126 4.625 1.126 5.5C1.126 7.062 1.914 8.437 3.128 9.187C2.383 9.187 1.672 8.937 1.05 8.562V8.625C1.05 10.812 2.618 12.625 4.796 13.062C4.387 13.187 3.942 13.25 3.483 13.25C3.172 13.25 2.862 13.25 2.57 13.187C3.161 15.062 4.884 16.437 6.942 16.437C5.378 17.687 3.409 18.437 1.252 18.437C0.876 18.437 0.502 18.437 0.128 18.375C2.214 19.812 4.702 20.687 7.377 20.687C16.828 20.687 21.554 12.937 21.554 6.25C21.554 6.062 21.554 5.875 21.545 5.687C22.428 5.062 23.118 4.25 23.643 4.937Z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 lg:flex-1 ">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <h3 class="text-white uppercase font-semibold">Navigasi</h3>
                            <a href="{{ route('home') }}"
                                class="block mt-2 text-sm text-gray-400 hover:text-green-400">Home</a>
                            <a href="{{ route('challenges') }}"
                                class="block mt-2 text-sm text-gray-400 hover:text-green-400">Challenges</a>
                            <a href="{{ route('leaderboards') }}"
                                class="block mt-2 text-sm text-gray-400 hover:text-green-400">Leaderboards</a>
                        </div>

                        <div>
                            <h3 class="text-white uppercase font-semibold">Komunitas</h3>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:text-green-400">Discord</a>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:text-green-400">Forum</a>
                        </div>

                        {{-- Bagian Legal sudah dihapus --}}

                    </div>
                </div>
            </div>

            <hr class="h-px my-6 bg-gray-800 border-none">

            <div>
                <p class="text-center text-gray-500">
                    © {{ date('Y') }} CTFPlatform - All rights reserved
                </p>
            </div>
        </div>
    </footer>
</div>