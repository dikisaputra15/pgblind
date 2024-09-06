<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubincidenttypeController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-08-29', '2024-08-31'];
        $sutypes = DB::table('wp_w2gm_locations_relationships')
            ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
            ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name', 'wp_posts.post_date')
            // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2581)
                        ->orwhere('wp_terms.term_id', 2582)
                        ->orwhere('wp_terms.term_id', 2585)
                        ->orwhere('wp_terms.term_id', 2584)
                        ->orwhere('wp_terms.term_id', 2586)
                        ->orwhere('wp_terms.term_id', 2583)
                        ->orwhere('wp_terms.term_id', 2588)
                        ->orwhere('wp_terms.term_id', 2591)
                        ->orwhere('wp_terms.term_id', 2595)
                        ->orwhere('wp_terms.term_id', 2587)
                        ->orwhere('wp_terms.term_id', 2594)
                        ->orwhere('wp_terms.term_id', 2589)
                        ->orwhere('wp_terms.term_id', 2590)
                        ->orwhere('wp_terms.term_id', 2592)
                        ->orwhere('wp_terms.term_id', 2593)
                        ->orwhere('wp_terms.term_id', 2596)
                        ->orwhere('wp_terms.term_id', 2600)
                        ->orwhere('wp_terms.term_id', 2599)
                        ->orwhere('wp_terms.term_id', 2597)
                        ->orwhere('wp_terms.term_id', 2598)
                        ->orwhere('wp_terms.term_id', 2673)
                        ->orwhere('wp_terms.term_id', 2672)
                        ->orwhere('wp_terms.term_id', 2670)
                        ->orwhere('wp_terms.term_id', 2676)
                        ->orwhere('wp_terms.term_id', 2675)
                        ->orwhere('wp_terms.term_id', 2674)
                        ->orwhere('wp_terms.term_id', 2671)
                        ->orwhere('wp_terms.term_id', 2689)
                        ->orwhere('wp_terms.term_id', 2688)
                        ->orwhere('wp_terms.term_id', 2677)
                        ->orwhere('wp_terms.term_id', 2684)
                        ->orwhere('wp_terms.term_id', 2685)
                        ->orwhere('wp_terms.term_id', 2686)
                        ->orwhere('wp_terms.term_id', 2679)
                        ->orwhere('wp_terms.term_id', 2678)
                        ->orwhere('wp_terms.term_id', 2681)
                        ->orwhere('wp_terms.term_id', 2680)
                        ->orwhere('wp_terms.term_id', 2682)
                        ->orwhere('wp_terms.term_id', 2687)
                        ->orwhere('wp_terms.term_id', 2683)
                        ->orwhere('wp_terms.term_id', 2709)
                        ->orwhere('wp_terms.term_id', 2703)
                        ->orwhere('wp_terms.term_id', 2710)
                        ->orwhere('wp_terms.term_id', 2715)
                        ->orwhere('wp_terms.term_id', 2704)
                        ->orwhere('wp_terms.term_id', 2717)
                        ->orwhere('wp_terms.term_id', 2705)
                        ->orwhere('wp_terms.term_id', 2716)
                        ->orwhere('wp_terms.term_id', 2706)
                        ->orwhere('wp_terms.term_id', 2713)
                        ->orwhere('wp_terms.term_id', 2712)
                        ->orwhere('wp_terms.term_id', 2711)
                        ->orwhere('wp_terms.term_id', 2708)
                        ->orwhere('wp_terms.term_id', 2707)
                        ->orwhere('wp_terms.term_id', 2714)
                        ->orwhere('wp_terms.term_id', 2724)
                        ->orwhere('wp_terms.term_id', 2718)
                        ->orwhere('wp_terms.term_id', 2725)
                        ->orwhere('wp_terms.term_id', 2730)
                        ->orwhere('wp_terms.term_id', 2719)
                        ->orwhere('wp_terms.term_id', 2732)
                        ->orwhere('wp_terms.term_id', 2720)
                        ->orwhere('wp_terms.term_id', 2731)
                        ->orwhere('wp_terms.term_id', 2728)
                        ->orwhere('wp_terms.term_id', 2727)
                        ->orwhere('wp_terms.term_id', 2726)
                        ->orWhere('wp_terms.term_id', 2635)
                        ->orWhere('wp_terms.term_id', 2722)
                        ->orWhere('wp_terms.term_id', 2729)
                        ->orWhere('wp_terms.term_id', 2695)
                        ->orWhere('wp_terms.term_id', 2696)
                        ->orWhere('wp_terms.term_id', 2698)
                        ->orWhere('wp_terms.term_id', 2697)
                        ->orWhere('wp_terms.term_id', 2699)
                        ->orWhere('wp_terms.term_id', 2700)
                        ->orWhere('wp_terms.term_id', 2702)
                        ->orWhere('wp_terms.term_id', 2701);
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
