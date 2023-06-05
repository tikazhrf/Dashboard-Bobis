@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Schedule</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Edit Ticket Schedule</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/updatejadwal/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label>Bus Code</label>
                                <select class="custom-select" name="code_bus">
                                    <option value="{{ $data->code_bus }}">{{ ucfirst($data->code_bus) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Origin</label>
                                <select class="custom-select" name="origin">
                                    <option value="{{ $data->origin }}">{{ ucfirst($data->origin) }}</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Destination</label>
                                <select class="custom-select" name="destination">
                                    <option value="{{ $data->destination }}">{{ ucfirst($data->destination) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Start At</label>
                                <input type="time" name="start_at" class="form-control" required=""
                                    value="{{ $data->start_at }}">
                            </div>
                            <div class="form-group col-6">
                                <label>End At</label>
                                <input type="time" name="end_at" class="form-control" required=""
                                    value="{{ $data->end_at }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="d-block">Operation Day</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox1" value="Monday">
                                    <label class="form-check-label" for="inlineCheckbox1">Monday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox2" value="Tuesday">
                                    <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox3" value="Wednesday">
                                    <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox4" value="Thursday">
                                    <label class="form-check-label" for="inlineCheckbox4">Thursday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox5" value="Friday">
                                    <label class="form-check-label" for="inlineCheckbox5">Friday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox6" value="Saturday">
                                    <label class="form-check-label" for="inlineCheckbox6">Saturday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="operation_day[]" type="checkbox"
                                        id="inlineCheckbox7" value="Sunday">
                                    <label class="form-check-label" for="inlineCheckbox7">Sunday</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
