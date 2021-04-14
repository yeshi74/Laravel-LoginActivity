@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3>User Table</h3></center>               
                </div>
                @if(session()->has('success'))
    <div class="alert alert-danger" id="dangerid">
        {{ session()->get('success') }}
    </div>
@endif

<script>
setTimeout(function() {
    $('#dangerid').fadeOut('fast');
}, 3000);
</script>

@if(session()->has('updated'))
<div class="alert alert-success" id="successid">
    {{ session()->get('updated') }}
</div>
@endif

<script>
setTimeout(function() {
$('#successid').fadeOut('fast');
}, 3000);
</script>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone Number
                                    </th>
                                    <th>
                                        Birthday
                                    </th>
                                    <th>
                                        Message
                                    </th>
                                    <th>
                                        Address
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $user->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($user->dob)) }}
                                        </td>
                                        <td>
                                            {{ $user->notes }}
                                        </td>
                                        <td>
                                            {{ $user->address }}
                                        </td>
                                        <td>
                                            <form action="{{ route('myusers.delete', $user->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('myusers.edit', $user->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                          
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection