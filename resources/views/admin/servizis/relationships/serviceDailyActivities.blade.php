<div class="m-3">
    @can('daily_activity_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.daily-activities.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.dailyActivity.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.dailyActivity.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-serviceDailyActivities">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.dailyActivity.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.dailyActivity.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.dailyActivity.fields.service') }}
                            </th>
                            <th>
                                {{ trans('cruds.dailyActivity.fields.day') }}
                            </th>
                            <th>
                                {{ trans('cruds.dailyActivity.fields.worktime') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dailyActivities as $key => $dailyActivity)
                            <tr data-entry-id="{{ $dailyActivity->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $dailyActivity->id ?? '' }}
                                </td>
                                <td>
                                    {{ $dailyActivity->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $dailyActivity->service->nome_servizio ?? '' }}
                                </td>
                                <td>
                                    {{ $dailyActivity->day ?? '' }}
                                </td>
                                <td>
                                    {{ $dailyActivity->worktime ?? '' }}
                                </td>
                                <td>
                                    @can('daily_activity_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.daily-activities.show', $dailyActivity->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('daily_activity_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.daily-activities.edit', $dailyActivity->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('daily_activity_delete')
                                        <form action="{{ route('admin.daily-activities.destroy', $dailyActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('daily_activity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.daily-activities.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-serviceDailyActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
})

</script>
@endsection