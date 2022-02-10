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
                        <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                                UMKM</label>
                                            @error('name')
                                                <x-input type="text" name="name" id="name" class="mt-1"
                                                    :isValid="false" value="{{ old('name') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="name" id="name" class="mt-1"
                                                    value="{{ old('name') }}">
                                                </x-input>
                                            @enderror
                                            {{-- <input type="text" name="name" id="name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('name') }}"> --}}
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="description"
                                                class="block text-sm font-medium text-gray-700">Deskripsi
                                            </label>
                                            @error('description')
                                                <x-input type="text" name="description" id="description"
                                                    class="mt-1" :isValid="false"
                                                    value="{{ old('description') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="description" id="description"
                                                    class="mt-1" value="{{ old('description') }}">
                                                </x-input>
                                            @enderror
                                            {{-- <input type="text" name="description" id="description"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('deskripsi') }}"> --}}
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat
                                            </label>
                                            @error('address')
                                                <x-input type="text" name="address" id="address" class="mt-1"
                                                    :isValid="false" value="{{ old('address') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="address" id="address" class="mt-1"
                                                    value="{{ old('address') }}">
                                                </x-input>
                                            @enderror
                                            {{-- <input type="text" name="address" id="address"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ old('address') }}"> --}}
                                        </div>


                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                            <x-input input="select" id="kecamatan_id" name="kecamatan_id">
                                                @foreach ($kecamatans as $kecamatan)
                                                    <option value="{{ $kecamatan->id }}" @if (old('kecamatan_id') == $kecamatan->id) selected @endif>
                                                        {{ $kecamatan->name }}
                                                    </option>
                                                @endforeach
                                            </x-input>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Pemilik</label>
                                            <x-input input="select" id="user_id" name="user_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if (old('user_id') == $user->id) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </x-input>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country" class="block text-sm font-medium text-gray-700">Jenis
                                                UMKM</label>
                                            <x-input input="select" id="jenis_umkm_id" name="jenis_umkm_id">
                                                @foreach ($jenisUmkms as $jenisUmkm)
                                                    <option value="{{ $jenisUmkm->id }}" @if (old('jenis_umkm_id') == $jenisUmkm->id) selected @endif>
                                                        {{ $jenisUmkm->name }}
                                                    </option>
                                                @endforeach
                                            </x-input>
                                        </div>

                                        {{-- <div class="col-span-6 sm:col-span-6">
                                            <label for="photo"
                                                class="form-label inline-block mb-2 text-gray-700">Foto</label>
                                            <input
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                type="file" name="photo" id="photo">
                                            @error('photo')
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <div class="col-span-6">
                                            <label for="photo"
                                                class="block text-sm font-medium text-gray-700">Foto</label>
                                            <div class="increment">
                                                <div class="mt-1 relative rounded-md shadow-sm input-group">
                                                    <input type="file" name="photo[]" id="photo"
                                                        class=" w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                        placeholder="0.00">
                                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                                        <x-buttons type="button"
                                                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 btn-add">
                                                            +</x-buttons>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('photo'))
                                                <ul class="text-red-500">
                                                    @foreach ($errors->get('photo') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="clone invisible">
                                                <div class="mt-1 relative rounded-md shadow-sm input-group">
                                                    <input type="file" name="photo[]" id="photo"
                                                        class=" w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                        placeholder="0.00">
                                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                                        <x-buttons type="button"
                                                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-red-500 btn-remove">
                                                            -</x-buttons>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $klasifikasi_umum = ['usaha mikro', 'usaha kecil', 'usaha menengah'];
                                            $status_umkm = ['umkm sudah berizin usaha', 'umkm belum berizin usaha'];
                                        @endphp
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Klasifikasi
                                                UMKM</label>
                                            <x-input input="select" id="klasifikasi_umum" name="klasifikasi_umum">
                                                @foreach ($klasifikasi_umum as $ku)
                                                    <option value="{{ $ku }}" @if (old('klasifikasi_umum') === $ku) selected @endif>
                                                        {{ ucwords($ku) }}
                                                    </option>
                                                @endforeach
                                            </x-input>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country" class="block text-sm font-medium text-gray-700">Status
                                                Usaha</label>
                                            <x-input input="select" id="status_umkm" name="status_umkm">
                                                @foreach ($status_umkm as $su)
                                                    <option value="{{ $su }}" @if (old('status_umkm') === $su) selected @endif>
                                                        {{ ucwords($su) }}
                                                    </option>
                                                @endforeach
                                            </x-input>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="lat" class="block text-sm font-medium text-gray-700">Latitude
                                            </label>
                                            @error('lat')
                                                <x-input type="text" name="lat" id="lat" class="mt-1"
                                                    :isValid="false" value="{{ old('lat') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="lat" id="lat" class="mt-1"
                                                    value="{{ old('lat') }}">
                                                </x-input>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="lng" class="block text-sm font-medium text-gray-700">Longitude
                                            </label>
                                            @error('lng')
                                                <x-input type="text" name="lng" id="lng" class="mt-1"
                                                    :isValid="false" value="{{ old('lng') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="lng" id="lng" class="mt-1"
                                                    value="{{ old('lng') }}">
                                                </x-input>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-full mt-4">
                                        <div id="here-maps">
                                            <label for="">Pin Location</label>
                                            <div style="height: 500px; width: 100% !important;" id="mapContainer"></div>
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
            $(document).ready(function() {
                $(".btn-add").click(function() {
                    let markup = $(".invisible").html();
                    $(".increment").append(markup);
                    console.log("test", markup)
                });
                $("body").on("click", ".btn-remove", function() {
                    $(this).parents(".input-group").remove();
                })
            })
        </script>
    @endpush
</x-app-layout>
