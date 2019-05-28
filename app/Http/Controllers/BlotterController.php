<?php
namespace App\Http\Controllers;

use App\Http\Requests\BlotterRequest;
use App\Blotter;
use Illuminate\Http\Request;

class BlotterController extends Controller
{

    public function index()
    {
        $blotters = Blotter::all();
        $blotterWithResident = $blotters->load('complainant', 'complained', 'officer');
        return $blotterWithResident;
    }


    public function index1(Request $request)
    {

        $columns = ['case_no', 'complainant', 'complained_resident', 'status', 'filing_date'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $search = $request->input('search');

        $query = Blotter::select('id', 'case_no', 'complainant', 'complainant_residentid', 'status', 'filing_date')
            ->orderBy($columns[$column], $dir);
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('complainant_residentid', 'like', "%$search%")
                    ->orWhere('filing_date', 'like', "%$search%")
                    ->orWhere('case_no', 'like', "%$search%");
            });
        }

        $blotters = $query->paginate($length);
        $blotters = $blotters->load('complainant', 'complained');

        return [
            'data' => $blotters->all(), 'draw' => \Request::input('draw')
        ];
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'case_no' => 'required|max:20|unique:blotters',
            'case_name' => 'required|string|max:100',
            'complainant_residentid' => 'required',
            'complained_residentid' => 'required',
            'officer_residentid' => 'required',
            'status' => 'required',
            'status' => 'required',
            'filing_date' => 'required',
            'description' => 'required|string|min:20|max:250',
            'description' => 'required',


        ]);

        $blotter = Blotter::create($request->all());
        return response()->json($blotter, 201);
    }
    public function show($id)
    {

        $blotter = Blotter::findOrFail($id);
        $blotter = $blotter->load('complainant', 'complained', 'officer');
        return response()->json($blotter);
    }
    public function update(Request $request, $id)
    {
        $blotter = Blotter::findOrFail($id);
        $blotter->update($request->all());
        return response()->json($blotter, 200);
    }
    public function destroy($id)
    {
        Blotter::destroy($id);
        return response()->json(null, 204);
    }
}
