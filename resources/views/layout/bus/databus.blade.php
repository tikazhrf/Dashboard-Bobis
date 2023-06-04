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

        {{-- @if ($message = Session::get('success'))
  <div class="alert alert-success">
    {{ $message }}
  </div>
  @endif --}}
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
                                        <a href="/tambahbus" class="btn btn-primary">Add Bus</a>
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
                                    <th>Seat</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $index => $row)
                                    <tr class="align-items-center">
                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                        <td>{{ $row->namapo }}</td>
                                        <td>
                                            <img src="{{ asset('busimage/' . $row->image) }}" alt=""
                                                style="width: 100px;">
                                        </td>
                                        <td>{{ $row->code_bus }}</td>
                                        <td>{{ $row->vin }}</td>
                                        <td>{{ $row->plate_number }}</td>
                                        <td>{{ $row->bpkb_expired }}</td>
                                        <td>{{ $row->driver }}</td>
                                        <td>{{ $row->seat }}</td>
                                        <td>
                                            <a href="/tampilbus/{{ $row->id }}"
                                                class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                            <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                                data-id="{{ $row->id }}" data-nama="{{ $row->code_bus }}"></a>
                                        </td>
                                    </tr>
                                @endforeach
                        </div>
                        </table>
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
        $('.delete').click(function() {
            var busid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                    title: "Are you sure?",
                    text: "You will clear bus data with Code Bus " + nama + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deletebus/" + busid + ""
                        swal("The data bus has been successfully deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal({
                            text: " " + nama + " is not deleted!"
                        });
                    }
                });
        });

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endsection
