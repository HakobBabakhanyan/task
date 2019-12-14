<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            view()->share([
                'page' => 'users',
            ]);
            return $next($request);
        });
    }

    public function main(){
        $data = [
            'items' => User::make()->getWithRelations(),
        ];
        return view('users.main', $data);
    }

    public function add(){
        $data = [
            'edit' => false,
            'countries' => Country::make()->get(),
        ];
        return view('users.form', $data);
    }

    public function add_put(Request $request){
        $country = Country::make();
        $country_list = $country->get();
        $user = User::make();
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'country_id'=>[
                'required',
                'integer',
                function($attribute, $value, $fail) use ($country_list) {
                    if (!$country_list->where('id', $value)->count()) $fail('Country does not exist.');
                }
            ],
            'role' => 'required|array|min:1|max:5',
            'role.*' => 'required|string|max:255'
        ]);
        $inputs = $request->all();
        $inputs['role'] = collect($inputs['role'])->unique()->values()->toArray();
        $id = $user->insert($request->all());
        return redirect()->route('users.edit', ['id'=>$id])->with('status', 'added');
    }

    public function edit($id){
        $model = User::make();
        $item = $model->get()->where('id', $id)->first();
        if (!$item) abort(404);
        $data = ['item'=>$item, 'edit'=>true, 'countries'=>Country::make()->get()];
        return view('users.form', $data);
    }

    public function edit_patch(Request $request, $id) {
        $country = Country::make();
        $country_list = $country->get();
        $user = User::make();
        $item = $user->get()->where('id', $id)->first();
        if (!$item) abort(404);
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'country_id'=>[
                'required',
                'integer',
                function($attribute, $value, $fail) use ($country_list) {
                    if (!$country_list->where('id', $value)->count()) $fail('Country does not exist.');
                }
            ],
            'role' => 'required|array|min:1|max:5',
            'role.*' => 'required|string|max:255'
        ]);
        $inputs = $request->all();
        $inputs['role'] = collect($inputs['role'])->unique()->values()->toArray();
        $user->update($id, $request->all());
        return redirect()->route('users.edit', ['id'=>$id])->with('status', 'edited');
    }

    public function delete(Request $request) {
        $user = User::make();
        $id = $request->input('id');
        if (!$id || !($model = $user->get()->where('id', $id)->first())) return redirect()->back();
        $user->delete($model['id']);
        return redirect()->back()->with('status', 'deleted');
    }
}
