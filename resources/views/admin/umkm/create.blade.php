<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl pb-3">Tambah UMKM</h1>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('admin.umkm.store') }}" method="POST">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700">Nama</label>
                                            <input type="text" name="name" id="name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="description"
                                                class="block text-sm font-medium text-gray-700">Deskripsi
                                            </label>
                                            <input type="text" name="description" id="description"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat
                                            </label>
                                            <input type="text" name="address" id="address"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>


                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                            <select id="kecamatan_id" name="kecamatan_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach ($kecamatans as $kecamatan)
                                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Pemilik</label>
                                            <select id="user_id" name="user_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country" class="block text-sm font-medium text-gray-700">Jenis
                                                UMKM</label>
                                            <select id="jenis_umkm_id" name="jenis_umkm_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach ($jenisUmkms as $jenisUmkm)
                                                    <option value="{{ $jenisUmkm->id }}">{{ $jenisUmkm->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="photos"
                                                class="form-label inline-block mb-2 text-gray-700">Foto</label>
                                            <input
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                type="file" name="photos" id="photos">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="lat" class="block text-sm font-medium text-gray-700">Latitude
                                            </label>
                                            <input type="text" name="lat" id="lat"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                readonly>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="lng" class="block text-sm font-medium text-gray-700">Longitude
                                            </label>
                                            <input type="text" name="lng" id="lng"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 gap-6 mt-4">
                                        <div id="here-maps">
                                            <label for="">Pin Location</label>
                                            <div style="height: 500px" id="mapContainer"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-buttons type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                        Tambah</x-buttons>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.action = "submit"
        </script>
    @endpush
</x-app-layout>
