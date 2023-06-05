@extends('app')

@section('content')
    <div class="section-header">
        <h1>Ticket Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a>Ticket Category</a></div>
        </div>
    </div>
    <div class="card-header-form">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Ticket Category</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <form action="kategoritiket" method="get">
                                        <a href="/tambahtiket" class="btn btn-primary">Add Ticket Category</a>
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
                                    <th>Ticket Category</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $row)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $row->ticket_category }}</td>
                                        <td>
                                            <a href="/tampiltiket/{{ $row->id }}"
                                                class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                            <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                                data-id="{{ $row->id }}" data-nama="{{ $row->ticket_category }}"></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete').click(function() {
            var tiketid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                    title: "Are you sure?",
                    text: "You will delete tickets with Ticket Category " + nama + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deletetiket/" + tiketid + ""
                        swal("The Ticket Category has been successfully deleted!", {
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
