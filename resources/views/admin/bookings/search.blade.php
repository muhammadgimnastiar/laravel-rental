@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Search Car
    </div>

    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control datetime" type="text" name="start_time" id="start_time" value="{{ request()->input('start_time') }}" placeholder="{{ trans('cruds.event.fields.start_time') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control datetime" type="text" name="end_time" id="end_time" value="{{ request()->input('end_time') }}" placeholder="{{ trans('cruds.event.fields.end_time') }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="form-control" type="number" name="capacity" id="capacity" value="{{ request()->input('capacity') }}" placeholder="{{ trans('cruds.car.fields.capacity') }}" step="1" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success">
                        Search
                    </button>
                </div>
            </div>
        </form>
        @if($cars !== null)
            <hr />
            @if($cars->count())
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.car') }}
                                </th>
                                <th>
                                    {{ trans('cruds.car.fields.capacity') }}
                                </th>
                                <th>
                                    {{ trans('cruds.car.fields.hourly_rate') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td class="car-name">
                                        {{ $car->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $car->capacity ?? '' }}
                                    </td>
                                    <td>
                                        {{ $car->hourly_rate ? '$' . number_format($car->hourly_rate, 2) : 'FREE' }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bookCar" data-car-id="{{ $car->id }}">
                                            Book Car
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">There are no cars available at the time you have chosen</p>
            @endif
        @endif
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="bookCar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking of a car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.bookCar') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="car_id" id="car_id" value="{{ old('car_id') }}">
                    <input type="hidden" name="start_time" value="{{ request()->input('start_time') }}">
                    <input type="hidden" name="end_time" value="{{ request()->input('end_time') }}">
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="recurring_until">Recurring until</label>
                        <input class="form-control date {{ $errors->has('recurring_until') ? 'is-invalid' : '' }}" type="text" name="recurring_until" id="recurring_until" value="{{ old('recurring_until') }}">
                        @if($errors->has('recurring_until'))
                            <div class="invalid-feedback">
                                {{ $errors->first('recurring_until') }}
                            </div>
                        @endif
                    </div>
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitBooking">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#bookCar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var carId = button.data('car-id');
    var modal = $(this);
    modal.find('#car_id').val(carId);
    modal.find('.modal-title').text('Booking of a car ' + button.parents('tr').children('.car-name').text());

    $('#submitBooking').click(() => {
        modal.find('button[type="submit"]').trigger('click');
    });
});
</script>
@endsection
