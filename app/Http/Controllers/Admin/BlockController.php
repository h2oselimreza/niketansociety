<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlockModuleRequest;
use App\Models\Block;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.blocks.index");
    }

    public function getBlockData(Request $request){
        if ($request->ajax()) {

            $block = Block::select([
                'id',
                'block_name',
                'block_order',
                'is_active',
            ]);

            return DataTables::of($block)

                ->addIndexColumn()

                ->addColumn('is_active', function ($block) {
                    return $block->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', content: function ($block) {
                    $viewUrl   = route('admin.block.module.show', $block->id);
                    $editUrl   = route('admin.block.module.edit', $block->id);
                    $deleteUrl = route('admin.block.module.destroy', $block->id);
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
        return view('admin.blocks.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlockModuleRequest $request)
    {
        Block::create($request->validated());
        return redirect()
        ->route('admin.block.module.index')
        ->with('success', 'Block created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        $data = $block;
        return view('admin.blocks.createEdit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlockModuleRequest $request, Block $block)
    {
        $block->update($request->validated());

        return redirect()
            ->route('admin.block.module.index')
            ->with('success', 'Block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        $block->delete();
        return redirect()
            ->route('admin.block.module.index')
            ->with('success', 'Block deleted successfully.');
    }
}
