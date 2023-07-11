@extends('app')

@section('content')
    <div class="section-header">
        <h1>Route Bus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a>Route Bus</a></div>
        </div>
    </div>
    <div class="card-header-form">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Route Bus</h4>
                        <div class="card-header-form">
                            <form action="rutebus" method="get">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search" name="search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                    @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO')
                                        <a href="/tambahrute" class="btn btn-primary ml-2">Add Route</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $row)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $row->origin->bus_stops }}</td>
                                        <td>{{ $row->destination->bus_stops }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td>
                                            <a href="#" class="btn btn-success rounded-circle fa fa-eye"
                                                onclick="showMap(event, 'map_{{ $row->id }}', {{ $row->origin->latitude }}, {{ $row->origin->longitude }}, {{ $row->destination->latitude }}, {{ $row->destination->longitude }})"></a>

                                            @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'managementPO')
                                                <a href="/tampilrute/{{ $row->id }}"
                                                    class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>

                                                <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                                    onclick="event.preventDefault(); showConfirmationModal({{ $row->id }});"></a>

                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('deleterute', $row->id) }}" method="POST"
                                                    style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="card map p-5" id="map_{{ $row->id }}"
                                                style="display: none; background-color: #DBDBDB;">
                                                <div id="map_{{ $row->id }}_content" class="map-content"
                                                    style="height: 450px;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
    </div>
@endsection

@section('script')
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css"
        type="text/css">
    <script>
        function showMap(event, mapId, originLat, originLng, destLat, destLng) {
            event.preventDefault();
            const mapContainer = $('#' + mapId);
            const mapContent = $('#' + mapId + '_content');

            if (mapContainer.is(':visible')) {
                // Menutup slideToggle saat ikon mata diakses lagi
                mapContainer.slideToggle();
                return;
            }

            // Menutup slideToggle pada peta lainnya
            $('.map').not(mapContainer).slideUp();

            mapContainer.slideToggle();

            if (mapContainer.is(':visible')) {
                mapboxgl.accessToken =
                    'pk.eyJ1IjoidGlrYXpocmYiLCJhIjoiY2xqMTFhNDZkMTB5azNjbzVzdGk1dXJjZSJ9.UMfuS2YOvHRE0YdnWDDP8g';

                const map = new mapboxgl.Map({
                    container: mapId + '_content',
                    style: 'mapbox://styles/mapbox/streets-v12',
                    center: [originLng, originLat],
                    zoom: 13,
                });

                const originMarker = new mapboxgl.Marker().setLngLat([originLng, originLat]).addTo(map);
                const destMarker = new mapboxgl.Marker().setLngLat([destLng, destLat]).addTo(map);

                map.on('load', function() {
                    const directions = new MapboxDirections({
                        accessToken: mapboxgl.accessToken,
                        unit: 'metric',
                        profile: 'mapbox/driving-traffic',
                        controls: {
                            inputs: false,
                        },
                        interactive: false,
                        styles: {
                            "id": "directions-route-line",
                            "type": "line",
                            "source": "directions",
                            "filter": ["all", ["in", "$type", "LineString"]],
                            "layout": {
                                "line-cap": "round",
                                "line-join": "round"
                            }
                        },
                    });
                    map.addControl(directions, 'top-left');
                    directions.setOrigin([originLng, originLat]);
                    directions.setDestination([destLng, destLat]);
                });
            }
        }

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
