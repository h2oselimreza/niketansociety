<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\BlockRoad;
use App\Models\Road;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockRoadController extends Controller
{
    public function index(){

        $blocks = Block::all();
        $roads = Road::all();

    // Get assigned roads
        $blockRoads = \DB::table('block_roads')
            ->where('status', 1)
            ->get()
            ->groupBy('block'); 
        return view("admin.block-road.index",compact("blocks","roads", "blockRoads"));
    }

     public function setRoad(Request $request)
    {
        $request->validate([
            'road'  => 'required',
            'block' => 'required'
        ]);

        $userId = Auth::id();

        $road = BlockRoad::where('road', $request->road)
                    ->where('block', $request->block)
                    ->first();

        if ($road) {
            // Toggle status
            $road->update([
                'status'        => $road->status == 1 ? 0 : 1,
                'updated_by'    => $userId,
                'updated_dt_tm' => now()
            ]);
        } else {
            BlockRoad::create([
                'road'          => $request->road,
                'block'         => $request->block,
                'status'        => 1,
                'created_by'    => $userId,
                'updated_by'    => $userId,
                'created_dt_tm' => now(),
                'updated_dt_tm' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Road status updated successfully'
        ]);
    }
}
