<div class="table-responsive">
    <table id="schoolsTable"
           class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800">
            <th>{{__('#')}}</th>
            <th>{{__('admin.Name')}}</th>
            <th>{{__('admin.Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr id="school_{{$item->id}}">
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>
                    <a href="{{route('schools.edit', $item->id)}}"
                       class="btn btn-icon btn-success btn-sm me-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteItem(this,'{{$item->id}}')"
                            class="btn btn-icon btn-danger btn-sm me-1">
                        <i class="fas fa-trash"></i>
                    </button>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
