<?php
namespace App\Http\Controllers;

use App\Purok;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PurokController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        return Purok::latest()->paginate(10);
    }

    public function searchPuroks()
    {
        if ($search = \Request::get('query')) {
            $puroks = Purok::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('leader', 'like', "%$search%")->get();
            });
            return response()->json($puroks);
        }

        // return $puroks;
    }
    public function getAllPuroks()
    {
        $purok = DB::table('puroks')->select('id', 'name')->get();
        return response()->json($purok);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:30|unique:puroks',
            // 'leader' => 'required|string|max:100',
        ]);


        $purok = Purok::create($request->all());
        return response()->json($purok, 201);
    }
    public function show($id)
    {
        $purok = Purok::findOrFail($id);
        return response()->json($purok);
    }
    public function update(Request $request, $id)
    {
        $purok = Purok::findOrFail($id);
        $purok->update($request->all());
        return response()->json($purok, 200);
    }
    public function destroy($id)
    {
        Purok::destroy($id);
        return response()->json(null, 204);
    }
}
