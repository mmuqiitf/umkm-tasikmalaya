<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jenis UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl pb-3">Ubah Jenis UMKM</h1>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('admin.jenis-umkm.update', $jenisUmkm->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                                Jenis UMKM</label>
                                            <input type="text" name="name" id="name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                value="{{ $jenisUmkm->name }}">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="status"
                                                class="block text-sm font-medium text-gray-700">Status</label>
                                            <select id="status" name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="1" @if ($jenisUmkm->status == 1) selected @endif>Aktif</option>
                                                <option value="0" @if ($jenisUmkm->status == 0) selected @endif>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-buttons type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                        Ubah</x-buttons>
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
