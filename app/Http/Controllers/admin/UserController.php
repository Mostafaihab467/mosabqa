<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserQuestionAnswers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'category')->get();
        foreach ($users as $user) {

            $user->degree = getDgree($user->id);
            $user->role = $user->roles->first()->display_name;
        }
        $result = [
            'data' => $users,
            'title' => __('admin.Users'),
        ];
//        return $result;
        return view('pages.admin.users.index', $result);
    }

    public function create()
    {
//        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
//        $user = User::create($request->all());
//        return redirect()->route('pages.admin.users.index');
    }

    public function show($id)
    {
        $user = User::with(['roles', 'category', 'userQuestionAnswers' => function ($query) {
            $query->with(['answer', 'question' => function ($query) {
                $query->with(['answers' => function ($query) {
                    $query->Correct();
                }]);
            }]);
        }])
        ->findOrFail($id);

        $user->degree = getDgree($user->id);
        $user->role = $user->roles->first()->display_name;

        $result = [
            'selectedItem' => $user,
            'title' => __('admin.User') . ' ' . $user->name,
        ];
//        return $result;
        return view('pages.admin.users.edit', $result);
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
//        $user = User::findOrFail($id);
//        $user->update($request->all());
//        return redirect()->route('pages.admin.users.index');
    }

    public function destroy($id)
    {
//        $user = User::findOrFail($id);
//        $user->delete();
//        return redirect()->route('pages.admin.users.index');
    }
}
