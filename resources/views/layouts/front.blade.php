<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <script>
        window.hereApiKey = "{{ env('HERE_API_KEY') }}"
        window.baseurl = "{{ url('') }}"
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .H_ib_body {
            width: 300px !important;
        }

        .modal {
            transition: opacity 0.25s ease;
        }

        body.modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }

    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                                {{ __('Homepage') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-buttons href="{{ route('login') }}"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">Login</x-buttons>
                        <x-buttons href="{{ route('register') }}"
                            class="ml-3 text-white bg-gray-600 hover:bg-gray-700 focus:ring-gray-500">Register
                        </x-buttons>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                        href="http://localhost/umkm-tasikmalaya/public/dashboard">
                        Dashboard
                    </a>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">Nandhita Oktaviani Amda</div>
                        <div class="font-medium text-sm text-gray-500">nandhita.amda@gmail.com</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <form method="POST" action="http://localhost/umkm-tasikmalaya/public/logout">
                            <input type="hidden" name="_token" value="kFstnxagnjy5RBdwdDCbLk1eXHBkCDjE6D40P80G">
                            <a class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
                                href="http://localhost/umkm-tasikmalaya/public/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                        fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div>
                        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                                aria-label="Global">
                                <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Website</a>

                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">UMKM</a>

                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Tasikmalaya</a>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">PEMETAAN</span>
                                <span class="block text-indigo-600 xl:inline">UMKM Tasikmalaya</span>
                            </h1>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Website ini berfungsi sebagai pemetaan dan pendataan Usaha Mikro Kecil dan
                                Menengah (UMKM) yang berada di wilayah Kota Tasikmalaya
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="#"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                        Mulai
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="{{ asset('peta-kota-tasik.png') }}" alt="">
            </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Fitur
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Berikut ini adalah fitur yang terdapat pada website
                    </p>
                </div>

                <div class="mt-10">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <!-- Heroicon name: outline/globe-alt -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Registrasi
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Pengguna dapat registrasi akun dan mendaftarkan UMKM nya.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <!-- Heroicon name: outline/scale -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Pendataan UMKM</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Pendataan UMKM dapat dilakukan oleh user ataupun oleh admin.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <!-- Heroicon name: outline/lightning-bolt -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Pencarian UMKM</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Pencarian UMKM berdasarkan kecamatan yang ada di Tasikmalaya.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <!-- Heroicon name: outline/annotation -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Maps</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Maps berfungsi sebagai penanda dari UMKM yang terdaftar di Tasikmalaya
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Maps
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Silahkan cari UMKM dari maps berikut. Klik icon hijau 2 kali untuk melihat data UMKM
                                nya.
                            </p>
                        </div>
                        <div>
                            <x-input input="select" id="kecamatan" name="kecamatan">
                                <option value="">- Pilih Salah Satu -</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">
                                        {{ $kecamatan->name }}
                                    </option>
                                @endforeach
                            </x-input>
                        </div>
                        <div class="border-t border-gray-200">
                            <div style="height: 500px" id="mapContainer"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-4 sm:px-3 lg:px-3">
                <div class="max-w-6xl mx-auto">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Summary
                            </h3>
                            <div class="mt-1 max-w-2xl text-sm text-gray-500" id="summary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div
                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Detail</h5>
                    <button type="button"
                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                UMKM</label>

                            <x-input type="text" name="name" id="name" class="mt-1" disabled>
                            </x-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                            </label>

                            <x-input type="text" name="description" id="description" class="mt-1" disabled>
                            </x-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat
                            </label>

                            <x-input type="text" name="address" id="address" class="mt-1" disabled>
                            </x-input>
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <label for="kecamatan_name"
                                class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <x-input type="text" name="kecamatan_name" id="kecamatan_name" class="mt-1"
                                value="" disabled>
                            </x-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="pemilik" class="block text-sm font-medium text-gray-700">Pemilik</label>
                            <x-input type="text" name="pemilik" id="pemilik" class="mt-1" value="" disabled>
                            </x-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="jenis_umkm" class="block text-sm font-medium text-gray-700">Jenis
                                UMKM</label>
                            <x-input type="text" name="jenis_umkm" id="jenis_umkm" class="mt-1" value=""
                                disabled>
                            </x-input>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="lat" class="block text-sm font-medium text-gray-700">Latitude
                            </label>
                            <x-input type="text" name="lat" id="lat" class="mt-1" value="" disabled>
                            </x-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="lng" class="block text-sm font-medium text-gray-700">Longitude
                            </label>

                            <x-input type="text" name="lng" id="lng" class="mt-1" value="" disabled>
                            </x-input>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="photo" class="form-label inline-block mb-2 text-gray-700">Foto</label>
                            <div class="container mx-auto">
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4" id="photo">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal-->
    {{-- <div
        class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-5xl mx-auto rounded shadow-lg z-50">

            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6 overflow-auto">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Detail</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama
                            UMKM</label>

                        <x-input type="text" name="name" id="name" class="mt-1" disabled>
                        </x-input>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                        </label>

                        <x-input type="text" name="description" id="description" class="mt-1" disabled>
                        </x-input>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat
                        </label>

                        <x-input type="text" name="address" id="address" class="mt-1" disabled>
                        </x-input>
                    </div>


                    <div class="col-span-6 sm:col-span-3">
                        <label for="kecamatan_name" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <x-input type="text" name="kecamatan_name" id="kecamatan_name" class="mt-1" value=""
                            disabled>
                        </x-input>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="pemilik" class="block text-sm font-medium text-gray-700">Pemilik</label>
                        <x-input type="text" name="pemilik" id="pemilik" class="mt-1" value="" disabled>
                        </x-input>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="jenis_umkm" class="block text-sm font-medium text-gray-700">Jenis
                            UMKM</label>
                        <x-input type="text" name="jenis_umkm" id="jenis_umkm" class="mt-1" value=""
                            disabled>
                        </x-input>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="lat" class="block text-sm font-medium text-gray-700">Latitude
                        </label>
                        <x-input type="text" name="lat" id="lat" class="mt-1" value="" disabled>
                        </x-input>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="lng" class="block text-sm font-medium text-gray-700">Longitude
                        </label>

                        <x-input type="text" name="lng" id="lng" class="mt-1" value="" disabled>
                        </x-input>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="photo" class="form-label inline-block mb-2 text-gray-700">Foto</label>
                        <div class="container mx-auto">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4" id="photo">
                            </div>
                        </div>
                    </div>


                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                </div>

            </div>
        </div>
    </div> --}}
    <script>
        window.action = "browse"
    </script>
    <script src="{{ asset('js/here.js') }}"></script>
</body>

</html>
