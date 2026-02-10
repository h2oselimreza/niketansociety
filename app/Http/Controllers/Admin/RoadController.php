<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoadModuleRequest;
use App\Models\Road;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.roads.index");
    }

    public function getRoadData(Request $request){
        if ($request->ajax()) {

            $road = Road::select([
                'id',
                'road_name',
                'road_order',
                'is_active',
            ]);

            return DataTables::of($road)

                ->addIndexColumn()

                ->addColumn('is_active', function ($road) {
                    return $road->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', content: function ($road) {
                    $viewUrl   = route('road.module.show', $road->id);
                    $editUrl   = route('road.module.edit', $road->id);
                    $deleteUrl = route('road.module.destroy', $road->id);
                    return '
                        <a href="'.$viewUrl.'" 
                        class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary action_button_modify">
                            <span class="ui-button-text">&nbsp;View</span>
                        </a>

                        <a href="'.$editUrl.'" 
                        class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary action_button_modify">
                            <span class="ui-button-text">&nbsp;Edit</span>
                        </a>

                        <a onclick="deleteRecord(\''.$deleteUrl.'\')" 
                        href="javascript:void(0)" 
                        class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary action_button_modify">
                            <span class="ui-button-text">&nbsp;Delete</span>
                        </a>
                    ';
                })

                ->rawColumns(['is_active', 'action'])
                ->make(true);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roads.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoadModuleRequest $request)
    {
        Road::create($request->validated());

        return redirect()
        ->route('road.module.index')
        ->with('success', 'Road created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Road $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Road $road)
    {
        $data = $road;
        return view('admin.roads.createEdit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoadModuleRequest $request, Road $road)
    {
        $road->update($request->validated());

        return redirect()
            ->route('road.module.index')
            ->with('success', 'Road updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Road $road)
    {
        $road->delete();
        return redirect()
            ->route('road.module.index')
            ->with('success', 'Road deleted successfully.');
    }
}
