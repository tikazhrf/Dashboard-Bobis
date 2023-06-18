@extends('app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="section-header">
        <h1>Detail User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item"><a>Detail User</a></div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('usermanagement') }}" class="btn btn-primary mr-3"><i class="fa-solid fa-arrow-left"></i>
                    Back</a>
                <h4>Detail User</h4>
                <div class="card-header-form">
                    <form>
                        <div class="input-group">
                            <form action="rutebus" method="get">
                                <input type="search" class="form-control" placeholder="Search" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $row)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td class="align-middle">
                                    @if ($row->image == null)
                                        <img class="img-fluid border rounded-circle"
                                            style="object-fit: cover; width: 40px; height: 40px;"
                                            src="{{ asset('style/dist/assets/img/logo_bobus.png') }}" alt="" />
                                    @else
                                        <img class="img-fluid border rounded-circle"
                                            style="object-fit: cover; width: 40px; height: 40px;"
                                            src="{{ asset('style/dist/assets/img/' . $row->image) }}" alt="" />
                                    @endif
                                </td>
                                <td class="align-middle">{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td class="align-middle">{{ $row->email }}</td>
                                <td class="align-middle">{{ $row->notelp }}</td>
                                <td class="align-middle">{{ $row->address }}</td>
                                <td class="align-middle">{{ $row->status }}</td>
                                <td class="align-middle">
                                    <a href="/tampilmanagement/{{ $row->id }}"
                                        class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                    <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                        onclick="event.preventDefault(); showConfirmationModal({{ $row->id }});"></a>

                                    <form id="delete-form-{{ $row->id }}"
                                        action="{{ route('deleteuser', $row->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function showConfirmationModal(id) {
            Swal.fire({
                title: "Konfirmasi Penghapusan",
                text: "Anda yakin ingin menghapus item ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endsection
