<x-app-layout>
    @if (session('success'))
        <div class="success-session" data-flashdata="{{ session('success') }}"></div>
    @elseif(session('danger'))
        <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-2xl pb-3">List User</h1>
                        </div>
                        <div>
                            <x-buttons href="{{ route('admin.user.create') }}"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                Tambah</x-buttons>
                        </div>
                    </div>
                    <table id="user-table" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jumlah UMKM</th>
                                <th>Role</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                        </tbody>

                    </table>
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
            let table = $('#user-table').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.user.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'umkm',
                            name: 'umkm'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                })
                .columns.adjust()
                .responsive.recalc();

            function reload_table(callback, resetPage = false) {
                table.ajax.reload(callback, resetPage); //reload datatable ajax 
            }


            $('#user-table').on('click', '.hapus_record', function(e) {
                let id = $(this).data('id')
                let name = $(this).data('name')
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus user dengan nama : ${name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('admin/user/') }}/" + id,
                            type: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                _method: "delete",
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.error) {
                                    Swal.fire(
                                        'Error!',
                                        response.error,
                                        'error'
                                    )
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        `User dengan nama : ${name} berhasil terhapus.`,
                                        'success'
                                    )
                                }
                                reload_table(null, true)
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    type: 'error',
                                    title: 'Error saat delete data',
                                    showConfirmButton: true
                                })
                            }
                        })
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>
