<?php
namespace App\Http\Controllers;

use App\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VoterRequest;
use Symfony\Component\Console\Helper\Table;

class VoterController extends Controller
{
    // public function index()
    // {
    //     $voters = Voter::latest()->get();
    //     return response()->json($voters);
    // }

    public function index(Request $request)
    {


        $columns = ['id', 'id_number', 'last_name', 'precint_number', 'date_registered'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $search = $request->input('search');

        $query = Voter::select(
            'voters.id',
            'id_number',
            'precint_number',
            'date_registered',
            'first_name',
            'middle_name',
            'last_name'
        )
            ->join('residents', 'voters.resident_id', '=', 'residents.id')
            ->orderBy($columns[$column], $dir);
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('middle_name', 'like', "%$search%")
                    ->orWhere('date_registered', 'like', "%$search%")
                    ->orWhere('id_number', 'like', "%$search%")
                    ->orWhere('precint_number', 'like', "%$search%");
            });
        }

        $voters = $query->paginate($length);

        return [
            'data' => $voters, 'draw' => \Request::input('draw')
        ];
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_number' => 'required|max:15|unique:voters',
            'precint_number' => 'required|max:10',
            'date_registered' => 'required',
            'resident_id' => 'required|unique:voters',
        ]);

        $voter = Voter::create($request->all());
        return response()->json($voter, 201);
    }
    public function show($id)
    {
        $voter = Voter::findOrFail($id);
        return response()->json($voter);
    }
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'id_number' => 'required|max:15|unique:voters,id_number,' . $id,
            'precint_number' => 'required|max:10',
            'date_registered' => 'required',
            'resident_id' => 'required|unique:voters,resident_id,' . $id,
        ]);

        $voter = Voter::findOrFail($id);
        $voter->update($request->all());
        return response()->json($voter, 200);
    }
    public function destroy($id)
    {
        Voter::destroy($id);
        return response()->json(null, 204);
    }
}
