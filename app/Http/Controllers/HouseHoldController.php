<?php
namespace App\Http\Controllers;
use App\Http\Requests\HouseHoldRequest;
use App\HouseHold;
class HouseHoldController extends Controller
{
    public function index()
    {
        $households = HouseHold::latest()->get();
        return response()->json($households);
    }
    public function store(HouseHoldRequest $request)
    {
        $household = HouseHold::create($request->all());
        return response()->json($household, 201);
    }
    public function show($id)
    {
        $household = HouseHold::findOrFailw($id);
        return response()->json($household);
    }
    public function update(HouseHoldRequest $request, $id)
    {
        $household = HouseHold::findOrFail($id);
        $household->update($request->all());
        return response()->json($household, 200);
    }
    public function destroy($id)
    {
        HouseHold::destroy($id);
        return response()->json(null, 204);
    }
}