<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            view()->share([
                'page' => 'countries',
            ]);
            return $next($request);
        });
    }

    public function main(){
        $data = [
            'items' => Country::make()->get(),
        ];
        return view('countries.main', $data);
    }

    public function add(){
        return view('countries.form', ['edit'=>false]);
    }

    public function add_put(Request $request){
        $country = Country::make();
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($country) {
                    if ($country->get()->filter(function($item) use ($value){
                        return (mb_strtolower($value) == mb_strtolower($item['name']));
                    })->count()) $fail('Country already exists.');
                },
            ]
        ]);
        $id = $country->insert($request->all('name'));
        return redirect()->route('countries.edit', ['id'=>$id])->with('status', 'added');
    }

    public function edit($id){
        $model = Country::make();
        $item = $model->get()->where('id', $id)->first();
        if (!$item) abort(404);
        $data = ['item'=>$item, 'edit'=>true];
        return view('countries.form', $data);
    }

    public function edit_patch(Request $request, $id) {
        $country = Country::make();
        $item = $country->get()->where('id', $id)->first();
        if (!$item) abort(404);
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($country, $id) {
                    if ($country->get()->filter(function($item) use ($value, $id){
                        return (mb_strtolower($value) == mb_strtolower($item['name']) && $item['id']!=$id);
                    })->count()) $fail('Country already exists.');
                },
            ]
        ]);
        $country->update($id, $request->all('name'));
        return redirect()->route('countries.edit', ['id'=>$id])->with('status', 'edited');
    }

    public function delete(Request $request) {
        $country = Country::make();
        $id = $request->input('id');
        if (!$id || !($model = $country->get()->where('id', $id)->first())) return redirect()->back();
        $country->delete($model['id']);
        return redirect()->back()->with('status', 'deleted');
    }
}
