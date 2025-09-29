<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubincidenttypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];
        $sutypes = DB::table('g3c_w2gm_locations_relationships')
            ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
            ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name', 'g3c_posts.post_date')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('g3c_terms.term_id', 2581)
                        ->orwhere('g3c_terms.term_id', 2582)
                        ->orwhere('g3c_terms.term_id', 2585)
                        ->orwhere('g3c_terms.term_id', 2584)
                        ->orwhere('g3c_terms.term_id', 2586)
                        ->orwhere('g3c_terms.term_id', 2583)
                        ->orwhere('g3c_terms.term_id', 2588)
                        ->orwhere('g3c_terms.term_id', 2591)
                        ->orwhere('g3c_terms.term_id', 2595)
                        ->orwhere('g3c_terms.term_id', 2587)
                        ->orwhere('g3c_terms.term_id', 2594)
                        ->orwhere('g3c_terms.term_id', 2589)
                        ->orwhere('g3c_terms.term_id', 2590)
                        ->orwhere('g3c_terms.term_id', 2592)
                        ->orwhere('g3c_terms.term_id', 2593)
                        ->orwhere('g3c_terms.term_id', 2596)
                        ->orwhere('g3c_terms.term_id', 2600)
                        ->orwhere('g3c_terms.term_id', 2599)
                        ->orwhere('g3c_terms.term_id', 2597)
                        ->orwhere('g3c_terms.term_id', 2598)
                        ->orwhere('g3c_terms.term_id', 2673)
                        ->orwhere('g3c_terms.term_id', 2672)
                        ->orwhere('g3c_terms.term_id', 2670)
                        ->orwhere('g3c_terms.term_id', 2676)
                        ->orwhere('g3c_terms.term_id', 2675)
                        ->orwhere('g3c_terms.term_id', 2674)
                        ->orwhere('g3c_terms.term_id', 2671)
                        ->orwhere('g3c_terms.term_id', 2689)
                        ->orwhere('g3c_terms.term_id', 2688)
                        ->orwhere('g3c_terms.term_id', 2677)
                        ->orwhere('g3c_terms.term_id', 2684)
                        ->orwhere('g3c_terms.term_id', 2685)
                        ->orwhere('g3c_terms.term_id', 2686)
                        ->orwhere('g3c_terms.term_id', 2679)
                        ->orwhere('g3c_terms.term_id', 2678)
                        ->orwhere('g3c_terms.term_id', 2681)
                        ->orwhere('g3c_terms.term_id', 2680)
                        ->orwhere('g3c_terms.term_id', 2682)
                        ->orwhere('g3c_terms.term_id', 2687)
                        ->orwhere('g3c_terms.term_id', 2683)
                        ->orwhere('g3c_terms.term_id', 2709)
                        ->orwhere('g3c_terms.term_id', 2703)
                        ->orwhere('g3c_terms.term_id', 2710)
                        ->orwhere('g3c_terms.term_id', 2715)
                        ->orwhere('g3c_terms.term_id', 2704)
                        ->orwhere('g3c_terms.term_id', 2717)
                        ->orwhere('g3c_terms.term_id', 2705)
                        ->orwhere('g3c_terms.term_id', 2716)
                        ->orwhere('g3c_terms.term_id', 2706)
                        ->orwhere('g3c_terms.term_id', 2713)
                        ->orwhere('g3c_terms.term_id', 2712)
                        ->orwhere('g3c_terms.term_id', 2711)
                        ->orwhere('g3c_terms.term_id', 2708)
                        ->orwhere('g3c_terms.term_id', 2707)
                        ->orwhere('g3c_terms.term_id', 2714)
                        ->orwhere('g3c_terms.term_id', 2724)
                        ->orwhere('g3c_terms.term_id', 2718)
                        ->orwhere('g3c_terms.term_id', 2725)
                        ->orwhere('g3c_terms.term_id', 2730)
                        ->orwhere('g3c_terms.term_id', 2719)
                        ->orwhere('g3c_terms.term_id', 2732)
                        ->orwhere('g3c_terms.term_id', 2720)
                        ->orwhere('g3c_terms.term_id', 2731)
                        ->orwhere('g3c_terms.term_id', 2728)
                        ->orwhere('g3c_terms.term_id', 2727)
                        ->orwhere('g3c_terms.term_id', 2726)
                        ->orWhere('g3c_terms.term_id', 2635)
                        ->orWhere('g3c_terms.term_id', 2722)
                        ->orWhere('g3c_terms.term_id', 2729)
                        ->orWhere('g3c_terms.term_id', 2695)
                        ->orWhere('g3c_terms.term_id', 2696)
                        ->orWhere('g3c_terms.term_id', 2698)
                        ->orWhere('g3c_terms.term_id', 2697)
                        ->orWhere('g3c_terms.term_id', 2699)
                        ->orWhere('g3c_terms.term_id', 2700)
                        ->orWhere('g3c_terms.term_id', 2702)
                        ->orWhere('g3c_terms.term_id', 2701)
                        ->orWhere('g3c_terms.term_id', 4398)
                        ->orWhere('g3c_terms.term_id', 4397)
                        ->orWhere('g3c_terms.term_id', 4396)
                        ->orWhere('g3c_terms.term_id', 4395)
                        ->orWhere('g3c_terms.term_id', 4402);
            })
            ->get();

        if($sutypes->isNotEmpty()){
                foreach ($sutypes as $sutype){
                    DB::table('pgstatistiks')
                        ->where('id_listing', $sutype->id)
                        ->update([
                            'incident_type' => $sutype->name
                        ]);
                }
                echo "sukses";
        }else{
            echo "empty";
        }

    }
}
