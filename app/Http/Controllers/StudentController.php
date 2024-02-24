<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::query();
        $students = Filter::filter($students, $request, ['name', 'email', 'phone']);
        $students = $students->get();
        if (!count($students)) {
            return customResponse(__("api.no_data_found"), 404);
        }
        $data['data'] = StudentResource::collection($students);
        return customResponse($data, 200);
    }
}
