@extends('layouts.admin')
@section('content')
@can('car_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.cars.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.car.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.car.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Car">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.car.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.capacity') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.description') }}
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
                    @foreach($cars as $key => $car)
                        <tr data-entry-id="{{ $car->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $car->id ?? '' }}
                            </td>
                            <td>
                                {{ $car->name ?? '' }}
                            </td>
                            <td>
                                {{ $car->capacity ?? '' }}
                            </td>
                            <td>
                                {{ $car->description ?? '' }}
                            </td>
                            <td>
                                {{ $car->hourly_rate ?? '' }}
                            </td>
                            <td>
                                @can('car_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cars.show', $car->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('car_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cars.edit', $car->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('car_delete')
                                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('car_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cars.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Car:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection