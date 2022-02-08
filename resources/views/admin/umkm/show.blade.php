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

                                    @if ($umkm->status === 0)
                                        <div class="flex justify-center gap-4 mt-2">
                                            <div>
                                                <form method="post"
                                                    action="{{ route('admin.umkm.updateStatus', $umkm->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="1">
                                                    <x-buttons type="submit"
                                                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-green-500">
                                                        Valid</x-buttons>
                                                </form>
                                            </div>
                                            <div>
                                                <form method="post"
                                                    action="{{ route('admin.umkm.updateStatus', $umkm->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="2">
                                                    <x-buttons type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-red-500">
                                                        Tidak Valid</x-buttons>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <!-- This example requires Tailwind CSS v2.0+ -->
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:px-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Applicant Information
                                        </h3>
                                    </div>
                                    <div class="border-t border-gray-200">
                                        <dl>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Nama UMKM</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->name }}</dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->address }}</dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Kecamatan</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->kecamatan->name }}</dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Jenis UMKM</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->jenis_umkm->name }}</dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Pemilik</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->user->name }}</dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Klasifikasi Umum</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ ucwords($umkm->klasifikasi_umum) }}
                                                </dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Status Usaha</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ ucwords($umkm->status_umkm) }}
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Latitude, Longitude</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    {{ $umkm->latitude . ', ' . $umkm->longitude }}
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    @php
                                                        switch ($umkm->status) {
                                                            case 0:
                                                                echo '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-yellow-100 bg-yellow-600 rounded-full">Menunggu</span>';
                                                                break;
                                                            case 1:
                                                                echo '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-green-100 bg-green-600 rounded-full">Valid</span>';
                                                                break;
                                                            case 2:
                                                                echo '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">Tidak Valid</span>';
                                                                break;
                                                        
                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    @endphp
                                                </dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <ul role="list"
                                                        class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                                        <li
                                                            class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                            <div class="w-0 flex-1 flex items-center">
                                                                <!-- Heroicon name: solid/paper-clip -->
                                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span class="ml-2 flex-1 w-0 truncate">
                                                                    resume_back_end_developer.pdf </span>
                                                            </div>
                                                            <div class="ml-4 flex-shrink-0">
                                                                <a href="#"
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                    Download </a>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                            <div class="w-0 flex-1 flex items-center">
                                                                <!-- Heroicon name: solid/paper-clip -->
                                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span class="ml-2 flex-1 w-0 truncate">
                                                                    coverletter_back_end_developer.pdf </span>
                                                            </div>
                                                            <div class="ml-4 flex-shrink-0">
                                                                <a href="#"
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                    Download </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </dd>
                                            </div>
                                        </dl>
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
            $(document).ready(function() {
                let flashdatasukses = $('.success-session').data('flashdata');
                if (flashdatasukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: flashdatasukses,
                        type: 'success'
                    })
                }
            });
            window.action = "direction"
        </script>
    @endpush
</x-app-layout>
