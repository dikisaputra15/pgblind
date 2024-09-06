<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IncidenttypeController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-08-29', '2024-08-31'];

        $itypes = DB::table('wp_w2gm_locations_relationships')
            ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
            ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name', 'wp_posts.post_date')
            // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2573)
                      ->orWhere('wp_terms.term_id', 2564)
                      ->orWhere('wp_terms.term_id', 2571)
                      ->orWhere('wp_terms.term_id', 2561)
                      ->orWhere('wp_terms.term_id', 2568)
                      ->orWhere('wp_terms.term_id', 2570)
                      ->orWhere('wp_terms.term_id', 2565)
                      ->orWhere('wp_terms.term_id', 2567)
                      ->orWhere('wp_terms.term_id', 2559)
                      ->orWhere('wp_terms.term_id', 2562)
                      ->orWhere('wp_terms.term_id', 2566)
                      ->orWhere('wp_terms.term_id', 2574)
                      ->orWhere('wp_terms.term_id', 2560)
                      ->orWhere('wp_terms.term_id', 2569)
                      ->orWhere('wp_terms.term_id', 2563)
                      ->orWhere('wp_terms.term_id', 2572)
                      ->orWhere('wp_terms.term_id', 2576)
                      ->orWhere('wp_terms.term_id', 2578)
                      ->orWhere('wp_terms.term_id', 2577)
                      ->orWhere('wp_terms.term_id', 2580)
                      ->orWhere('wp_terms.term_id', 2579)
                      ->orWhere('wp_terms.term_id', 2654)
                      ->orWhere('wp_terms.term_id', 2633)
                      ->orWhere('wp_terms.term_id', 2659)
                      ->orwhere('wp_terms.term_id', 2663)
                      ->orwhere('wp_terms.term_id', 2668)
                      ->orwhere('wp_terms.term_id', 2666)
                      ->orwhere('wp_terms.term_id', 2632)
                      ->orwhere('wp_terms.term_id', 2660)
                      ->orwhere('wp_terms.term_id', 2667)
                      ->orwhere('wp_terms.term_id', 2649)
                      ->orwhere('wp_terms.term_id', 2647)
                      ->orwhere('wp_terms.term_id', 2669)
                      ->orwhere('wp_terms.term_id', 2645)
                      ->orwhere('wp_terms.term_id', 2646)
                      ->orwhere('wp_terms.term_id', 2650)
                      ->orwhere('wp_terms.term_id', 2637)
                      ->orwhere('wp_terms.term_id', 2664)
                      ->orwhere('wp_terms.term_id', 2652)
                      ->orwhere('wp_terms.term_id', 2644)
                      ->orwhere('wp_terms.term_id', 2643)
                      ->orwhere('wp_terms.term_id', 2635)
                      ->orwhere('wp_terms.term_id', 2634)
                      ->orwhere('wp_terms.term_id', 2656)
                      ->orwhere('wp_terms.term_id', 2665)
                      ->orwhere('wp_terms.term_id', 2662)
                      ->orwhere('wp_terms.term_id', 2641)
                      ->orwhere('wp_terms.term_id', 2631)
                      ->orwhere('wp_terms.term_id', 2642)
                      ->orwhere('wp_terms.term_id', 2639)
                      ->orwhere('wp_terms.term_id', 2653)
                      ->orwhere('wp_terms.term_id', 2651)
                      ->orwhere('wp_terms.term_id', 2657)
                      ->orwhere('wp_terms.term_id', 2658)
                      ->orwhere('wp_terms.term_id', 2638)
                      ->orwhere('wp_terms.term_id', 2640)
                      ->orwhere('wp_terms.term_id', 2661)
                      ->orwhere('wp_terms.term_id', 2655)
                      ->orwhere('wp_terms.term_id', 2693)
                      ->orwhere('wp_terms.term_id', 2694)
                      ->orwhere('wp_terms.term_id', 2691)
                      ->orwhere('wp_terms.term_id', 2692);
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
