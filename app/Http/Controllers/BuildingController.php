<?php

namespace App\Http\Controllers;

use Session;
use App\Http\RestAccess;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    private $rest;

    public function __construct()
    {
        $this->middleware('auth');
        $this->rest = new RestAccess('buildings');
    }

    public function index()
    {
        $data = $this->rest->all();
        return view('building.index', ['data' => $data]);
    }

    public function create()
    {
        return view('building.create');
    }

    public function edit($id)
    {
        $data = $this->rest->get($id);
        return view('building.edit', ["obj" => $data]);
    }

    public function store(Request $request)
    {
        $status = $this->rest->create($request->except('_token'));

        if ($status == 201) {
            return redirect()->route('building.index');
        }

        return redirect()->back()->withInput($request->all());
    }

    public function update($id, Request $request)
    {
        $status = $this->rest->update($id, $request->except('_token'));

        if ($status == 204) {
            return redirect()->route('building.index');
        }

        return redirect()->back()->withInput($request->all());
    }

    public function delete($id)
    {
        $status = $this->rest->delete($id);
        return redirect()->route('building.index');
    }
}
