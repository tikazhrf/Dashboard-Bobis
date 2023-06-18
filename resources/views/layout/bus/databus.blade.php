@extends('app')

@section('content')
    <div class="section-header">
        <h1>Data Bus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Data Bus</div>
        </div>
    </div>
    <div class="card-header-form">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Bus</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <form action="/databus" method="get">
                                        <input type="search" class="form-control" placeholder="Search" name="search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                        @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO')
                                            <a href="/tambahbus" class="btn btn-primary ml-2">Add Bus</a>
                                        @endif
                                        {{-- Session::get('halaman_url') --}}
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Company</th>
                                    <th>Logo</th>
                                    <th>Bus Code</th>
                                    <th>VIN</th>
                                    <th>Plate Number</th>
                                    <th>BPKB Expired</th>
                                    <th>Driver</th>
                                    <th>Total Seat</th>
                                    @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO')
                                        <th>Action</th>
                                    @endif
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $index => $row)
                                    <tr class="align-items-center">
                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                        <td>{{ $row->company->company_name }}</td>
                                        <td>
                                            <img src="{{ asset('busimage/' . $row->image) }}" alt=""
                                                style="width: 100px;">
                                        </td>
                                        <td>{{ $row->code_bus }}</td>
                                        <td>{{ $row->vin }}</td>
                                        <td>{{ $row->plate_number }}</td>
                                        <td>{{ $row->bpkb_expired }}</td>
                                        <td>{{ $row->driver }}</td>
                                        <td>{{ $row->total_seats }}</td>
                                        @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO')
                                            <td>
                                                <a href="/tampilbus/{{ $row->id }}"
                                                    class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                                <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                                    onclick="event.preventDefault(); showConfirmationModal({{ $row->id }});"></a>

                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('deletebus', $row->id) }}" method="POST"
                                                    style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $data->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
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
