<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IncidenttypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $itypes = DB::table('g3c_w2gm_locations_relationships')
            ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
            ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name', 'g3c_posts.post_date')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('g3c_terms.term_id', 2573)
                      ->orWhere('g3c_terms.term_id', 2564)
                      ->orWhere('g3c_terms.term_id', 2571)
                      ->orWhere('g3c_terms.term_id', 2561)
                      ->orWhere('g3c_terms.term_id', 2568)
                      ->orWhere('g3c_terms.term_id', 2570)
                      ->orWhere('g3c_terms.term_id', 2565)
                      ->orWhere('g3c_terms.term_id', 2567)
                      ->orWhere('g3c_terms.term_id', 2559)
                      ->orWhere('g3c_terms.term_id', 2562)
                      ->orWhere('g3c_terms.term_id', 2566)
                      ->orWhere('g3c_terms.term_id', 2574)
                      ->orWhere('g3c_terms.term_id', 2560)
                      ->orWhere('g3c_terms.term_id', 2569)
                      ->orWhere('g3c_terms.term_id', 2563)
                      ->orWhere('g3c_terms.term_id', 2572)
                      ->orWhere('g3c_terms.term_id', 2576)
                      ->orWhere('g3c_terms.term_id', 2578)
                      ->orWhere('g3c_terms.term_id', 2577)
                      ->orWhere('g3c_terms.term_id', 2580)
                      ->orWhere('g3c_terms.term_id', 2579)
                      ->orWhere('g3c_terms.term_id', 2654)
                      ->orWhere('g3c_terms.term_id', 2633)
                      ->orWhere('g3c_terms.term_id', 2659)
                      ->orwhere('g3c_terms.term_id', 2663)
                      ->orwhere('g3c_terms.term_id', 2668)
                      ->orwhere('g3c_terms.term_id', 2666)
                      ->orwhere('g3c_terms.term_id', 2632)
                      ->orwhere('g3c_terms.term_id', 2660)
                      ->orwhere('g3c_terms.term_id', 2667)
                      ->orwhere('g3c_terms.term_id', 2649)
                      ->orwhere('g3c_terms.term_id', 2647)
                      ->orwhere('g3c_terms.term_id', 2669)
                      ->orwhere('g3c_terms.term_id', 2645)
                      ->orwhere('g3c_terms.term_id', 2646)
                      ->orwhere('g3c_terms.term_id', 2650)
                      ->orwhere('g3c_terms.term_id', 2637)
                      ->orwhere('g3c_terms.term_id', 2664)
                      ->orwhere('g3c_terms.term_id', 2652)
                      ->orwhere('g3c_terms.term_id', 2644)
                      ->orwhere('g3c_terms.term_id', 2643)
                      ->orwhere('g3c_terms.term_id', 2635)
                      ->orwhere('g3c_terms.term_id', 2634)
                      ->orwhere('g3c_terms.term_id', 2656)
                      ->orwhere('g3c_terms.term_id', 2665)
                      ->orwhere('g3c_terms.term_id', 2662)
                      ->orwhere('g3c_terms.term_id', 2641)
                      ->orwhere('g3c_terms.term_id', 2631)
                      ->orwhere('g3c_terms.term_id', 2642)
                      ->orwhere('g3c_terms.term_id', 2639)
                      ->orwhere('g3c_terms.term_id', 2653)
                      ->orwhere('g3c_terms.term_id', 2651)
                      ->orwhere('g3c_terms.term_id', 2657)
                      ->orwhere('g3c_terms.term_id', 2658)
                      ->orwhere('g3c_terms.term_id', 2638)
                      ->orwhere('g3c_terms.term_id', 2640)
                      ->orwhere('g3c_terms.term_id', 2661)
                      ->orwhere('g3c_terms.term_id', 2655)
                      ->orwhere('g3c_terms.term_id', 2693)
                      ->orwhere('g3c_terms.term_id', 2694)
                      ->orwhere('g3c_terms.term_id', 2691)
                      ->orwhere('g3c_terms.term_id', 2692)
                      ->orwhere('g3c_terms.term_id', 4399)
                      ->orwhere('g3c_terms.term_id', 4400)
                      ->orwhere('g3c_terms.term_id', 4401)
                      ->orwhere('g3c_terms.term_id', 4403);
            })
            ->get();


            if($itypes->isNotEmpty()){
                foreach ($itypes as $itype){
                    DB::table('pgstatistiks')
                        ->where('id_listing', $itype->id)
                        ->update([
                            'incident_category' => $itype->name
                        ]);
                }
                echo "sukses";
            }else{
                echo "empty";
            }

    }
}
