<x-app-layout>
    @if (session('success'))
        <div class="success-session" data-flashdata="{{ session('success') }}"></div>
    @elseif(session('danger'))
        <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lihat UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1 mb-2">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Lokasi</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Berikut ini adalah lokasi dari UMKM {{ $umkm->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div style="height: 500px; width: 100% !important;" id="mapContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Use a permanent address where you can receive mail.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <h3>{{ $umkm->name }}</h3>
                                        <span>{{ $umkm->address }}</span>
                                        <p>{{ $umkm->description }}</p>
                                        <div id="summary"></div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.action = "direction"
        </script>
    @endpush
</x-app-layout>
