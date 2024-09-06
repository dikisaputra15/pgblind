<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TargetController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-08-29', '2024-08-31'];

        $targets = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->where('wp_terms.term_id', 2758)
                ->orWhere('wp_terms.term_id', 2785)
                ->orWhere('wp_terms.term_id', 2740)
                ->orWhere('wp_terms.term_id', 2771)
                ->orWhere('wp_terms.term_id', 2743)
                ->orWhere('wp_terms.term_id', 2764)
                ->orWhere('wp_terms.term_id', 2786)
                ->orWhere('wp_terms.term_id', 2767)
                ->orWhere('wp_terms.term_id', 2744)
                ->orWhere('wp_terms.term_id', 2737)
                ->orWhere('wp_terms.term_id', 2735)
                ->orWhere('wp_terms.term_id', 2772)
                ->orWhere('wp_terms.term_id', 2516)
                ->orWhere('wp_terms.term_id', 2738)
                ->orWhere('wp_terms.term_id', 2736)
                ->orWhere('wp_terms.term_id', 2773)
                ->orWhere('wp_terms.term_id', 2760)
                ->orWhere('wp_terms.term_id', 2770)
                ->orWhere('wp_terms.term_id', 2781)
                ->orWhere('wp_terms.term_id', 2763)
                ->orWhere('wp_terms.term_id', 2762)
                ->orWhere('wp_terms.term_id', 2761)
                ->orWhere('wp_terms.term_id', 2756)
                ->orWhere('wp_terms.term_id', 2787)
                ->orWhere('wp_terms.term_id', 2745)
                ->orWhere('wp_terms.term_id', 2778)
                ->orWhere('wp_terms.term_id', 2755)
                ->orWhere('wp_terms.term_id', 2748)
                ->orWhere('wp_terms.term_id', 2751)
                ->orWhere('wp_terms.term_id', 2741)
                ->orWhere('wp_terms.term_id', 2752)
                ->orWhere('wp_terms.term_id', 2792)
                ->orWhere('wp_terms.term_id', 2734)
                ->orWhere('wp_terms.term_id', 2774)
                ->orWhere('wp_terms.term_id', 2790)
                ->orWhere('wp_terms.term_id', 2782)
                ->orWhere('wp_terms.term_id', 2784)
                ->orWhere('wp_terms.term_id', 2783)
                ->orWhere('wp_terms.term_id', 2765)
                ->orWhere('wp_terms.term_id', 2757)
                ->orWhere('wp_terms.term_id', 2775)
                ->orWhere('wp_terms.term_id', 2754)
                ->orWhere('wp_terms.term_id', 2788)
                ->orWhere('wp_terms.term_id', 2746)
                ->orWhere('wp_terms.term_id', 2768)
                ->orWhere('wp_terms.term_id', 2769)
                ->orWhere('wp_terms.term_id', 2766)
                ->orWhere('wp_terms.term_id', 2742)
                ->orWhere('wp_terms.term_id', 2777)
                ->orWhere('wp_terms.term_id', 2739)
                ->orWhere('wp_terms.term_id', 2750)
                ->orWhere('wp_terms.term_id', 2747)
                ->orWhere('wp_terms.term_id', 2779)
                ->orWhere('wp_terms.term_id', 2780)
                ->orWhere('wp_terms.term_id', 2753)
                ->orWhere('wp_terms.term_id', 2791);
            })
        ->get();

        if($targets->isNotEmpty()){
            foreach ($targets as $target){
                DB::table('pgstatistiks')
                    ->where('id_listing', $target->id)
                    ->update([
                        'target' => $target->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
