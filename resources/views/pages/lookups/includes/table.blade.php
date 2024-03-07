<div class="table-responsive">
    <table id="categoriesTable"
           class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800">
            <th>{{__('#')}}</th>
            <th>{{__('admin.Name')}}</th>
            <th>{{__('admin.Value')}}</th>
            <th>{{__('admin.Status')}}</th>
            <th>{{__('admin.Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->value}}</td>
                <td>
                    <span class="badge badge-light-{{$item->record_state ? 'success' : 'danger'}}">
                    {{$item->record_state ? __('admin.Active') : __('admin.Not Active')}}
                    </span>
                </td>
                <td>
                    <a href="{{route('lookups.edit', $item->id)}}"
                       class="btn btn-icon btn-success btn-sm me-1">
                        <i class="fas fa-edit"></i>
                    </a>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
