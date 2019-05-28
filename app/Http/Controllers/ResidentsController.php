<?php

namespace App\Http\Controllers;

use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getNames()
    {
        return Resident::all();
        // return DB::select("SELECT CONCAT(last_name,' ',middle_name,' ',last_name) as `name` FROM residents ORDER BY last_name,first_name ASC");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateVoter($id)
    {
        $resident = Resident::findOrFail($id);

        return response()->json($resident);
    }
    public function count()
    {
        $residentsCount = DB::table('residents')->count('id');
        $femaleCount = DB::table('residents')->where('gender', '=', 'female')->count('gender');
        $voterCount = DB::table('residents')->where('is_Voter', '=', true)->count('is_voter');
        $maleCount = DB::table('residents')->where('gender', '=', 'male')->count('gender');
        $maleVoterCount = DB::table('residents')->where('gender', '=', 'male')->where('is_voter', '=', true)->count('gender');
        $femaleVoterCount = DB::table('residents')->where('gender', '=', 'female')->where('is_voter', '=', true)->count('gender');
        $blotterCount = DB::table('blotters')->count('id');
        $familyHeadCount = DB::table('residents')->where('is_familyhead', '=', true)->count('is_familyhead');
        $pwaCount = DB::table('residents')->where('is_pwa', '=', true)->count('is_pwa');
        return [
            'total' => [
                'residents' => $residentsCount,
                'male' => $maleCount,
                'female' => $femaleCount,
                'voter' => $voterCount,
                'familyHead' => $familyHeadCount,
                'femaleVoter' => $femaleVoterCount,
                'maleVoter' => $maleVoterCount,
                'blotters' => $blotterCount,
                'blotters' => $blotterCount,
                'pwa' => $pwaCount,

            ]
        ];
    }

    public function getId(Request $request)
    {
        $name = $request->get('name');
        $id = DB::select("SELECT id FROM residents WHERE CONCAT(first_name,' ',middle_name,' ',last_name) = ?", [$name]);
        return $id;
    }

    public function voterStatus(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->is_voter = $request->is_voter;
        $resident->save();
        return response()->json($resident);
    }


    public function index(Request $request)
    {
        $columns = ['first_name', 'middle_name', 'last_name', 'birth_date', 'gender', 'resident_id', 'purok'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $search = $request->input('search');

        $query = Resident::select('id', 'first_name', 'middle_name', 'last_name', 'purok', 'birth_date', 'gender', 'resident_id')
            ->orderBy($columns[$column], $dir);
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('middle_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            });
        }

        $residents = $query->paginate($length);

        return [
            'data' => $residents, 'draw' => \Request::input('draw')
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:100',
            'house_no' => 'required',
            'purok' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'resident_id' => 'required|unique:residents',
            'educational_attainment' =>
            'required|',
            'email' => 'email|unique:residents',
            'purok' => 'required',
            'contact_no' => 'required',
            'street_address' => 'required',
            'civil_status' => 'required',
            'birth_place' => 'required',
            'blood_type' => 'required',

        ]);

        $resident = Resident::create($request->all());
        return response()->json($resident, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json($resident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'first_name' => 'required|string|min:4|max:30',
            'last_name' => 'required|string|max:100',
            'house_no' => 'required',
            'purok' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'resident_id' => 'required|unique:residents,resident_id,' . $id,
            'purok' => 'required',
            'contact_no' => 'required|min:11|max:15',
            'educational_attainment' => 'required|',
            'email' => 'email|unique:residents,email,' . $id,
            'street_address' => 'required',
            'civil_status' => 'required',
            'birth_place' => 'required',
            'blood_type' => 'required',

        ]);

        $resident = Resident::findOrFail($id);
        $resident->update($request->all());
        return response()->json($resident, 200);
    }

    public function destroy($id)
    {
        Resident::destroy($id);
        return response()->json(null, 204);
    }
}
