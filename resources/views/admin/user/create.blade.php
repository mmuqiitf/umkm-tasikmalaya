<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kecamatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl pb-3">Tambah User</h1>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                            </label>
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
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="username"
                                                class="block text-sm font-medium text-gray-700">Username
                                            </label>
                                            @error('username')
                                                <x-input type="text" name="username" id="username" class="mt-1"
                                                    :isValid="false" value="{{ old('username') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="username" id="username" class="mt-1"
                                                    value="{{ old('username') }}">
                                                </x-input>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700">Password
                                            </label>
                                            @error('password')
                                                <x-input type="password" name="password" id="password"
                                                    class="mt-1" :isValid="false" value="{{ old('password') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="password" name="password" id="password"
                                                    class="mt-1" value="{{ old('password') }}">
                                                </x-input>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700">Password Confirmation
                                            </label>
                                            <x-input type="password" name="password_confirmation"
                                                id="password_confirmation" class="mt-1">
                                            </x-input>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK
                                            </label>
                                            @error('nik')
                                                <x-input type="text" name="nik" id="nik" class="mt-1"
                                                    :isValid="false" value="{{ old('nik') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="nik" id="nik" class="mt-1"
                                                    value="{{ old('nik') }}">
                                                </x-input>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            </label>
                                            @error('email')
                                                <x-input type="email" name="email" id="email" class="mt-1"
                                                    :isValid="false" value="{{ old('email') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="email" name="email" id="email" class="mt-1"
                                                    value="{{ old('email') }}">
                                                </x-input>
                                            @enderror
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
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Handphone
                                            </label>
                                            @error('phone')
                                                <x-input type="text" name="phone" id="phone" class="mt-1"
                                                    :isValid="false" value="{{ old('phone') }}">
                                                </x-input>
                                                <span class="text-sm text-red-700">{{ $message }}</span>
                                            @else
                                                <x-input type="text" name="phone" id="phone" class="mt-1"
                                                    value="{{ old('phone') }}">
                                                </x-input>
                                            @enderror
                                        </div>


                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700">Role</label>
                                            <x-input input="select" id="role" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="umkm">User</option>
                                            </x-input>
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

        </script>
    @endpush
</x-app-layout>
