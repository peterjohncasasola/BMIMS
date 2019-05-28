<?php
namespace App\Http\Controllers;

use App\Http\Requests\OfficialRequest;
use App\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{

    public function index()
    {
        return Official::all();
    }

    public function getCurrentOfficials()
    {
        return Official::where('status', '=', 'current')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:officials',
            'position' => 'required',
            'status' => 'required'
        ]);
        $official = Official::create($request->all());
        return response()->json($official, 201);
    }

    public function getAll()
    { }

    public function getId(Request $request)
    {
        $name = $request->get('name');
        $id = Official::select('id')->where('name', '=', $name)->get();
        return $id;
    }

    public function show($id)
    {
        $official = Official::findOrFail($id);
        return response()->json($official);
    }
    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);
        $official->update($request->all());
        return response()->json($official, 200);
    }
    public function destroy($id)
    {
        Official::destroy($id);
        return response()->json(null, 204);
    }
}
