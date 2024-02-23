<div class="table-responsive">
    <table id="questionsTable"
           class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800">
            <th>{{__('#')}}</th>
            <th>{{__('admin.Question')}}</th>
            <th>{{__('admin.sora')}}</th>
            <th>{{__('admin.Category')}}</th>
            <th>{{__('admin.Answers')}}</th>
            <th>{{__('admin.Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr id="question_{{$item->id}}">
                <td>{{$item->id}}</td>
                <td>{{$item->question}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->category->name}}</td>
                <td>
                    <ul>
                        @foreach($item->answers as $answer)
                            <li>
                                <span class="text text-{{$answer->is_correct ? 'success' : 'danger'}}">
                                    {{$answer->answer}}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                <td>
                    <a href="{{route('questions.edit', $item->id)}}"
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
