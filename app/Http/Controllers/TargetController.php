<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TargetController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $targets = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->where('g3c_terms.term_id', 2758)
                ->orWhere('g3c_terms.term_id', 2785)
                ->orWhere('g3c_terms.term_id', 2740)
                ->orWhere('g3c_terms.term_id', 2771)
                ->orWhere('g3c_terms.term_id', 2743)
                ->orWhere('g3c_terms.term_id', 2764)
                ->orWhere('g3c_terms.term_id', 2786)
                ->orWhere('g3c_terms.term_id', 2767)
                ->orWhere('g3c_terms.term_id', 2744)
                ->orWhere('g3c_terms.term_id', 2737)
                ->orWhere('g3c_terms.term_id', 2735)
                ->orWhere('g3c_terms.term_id', 2772)
                ->orWhere('g3c_terms.term_id', 2516)
                ->orWhere('g3c_terms.term_id', 2738)
                ->orWhere('g3c_terms.term_id', 2736)
                ->orWhere('g3c_terms.term_id', 2773)
                ->orWhere('g3c_terms.term_id', 2760)
                ->orWhere('g3c_terms.term_id', 2770)
                ->orWhere('g3c_terms.term_id', 2781)
                ->orWhere('g3c_terms.term_id', 2763)
                ->orWhere('g3c_terms.term_id', 2762)
                ->orWhere('g3c_terms.term_id', 2761)
                ->orWhere('g3c_terms.term_id', 2756)
                ->orWhere('g3c_terms.term_id', 2787)
                ->orWhere('g3c_terms.term_id', 2745)
                ->orWhere('g3c_terms.term_id', 2778)
                ->orWhere('g3c_terms.term_id', 2755)
                ->orWhere('g3c_terms.term_id', 2748)
                ->orWhere('g3c_terms.term_id', 2751)
                ->orWhere('g3c_terms.term_id', 2741)
                ->orWhere('g3c_terms.term_id', 2752)
                ->orWhere('g3c_terms.term_id', 2792)
                ->orWhere('g3c_terms.term_id', 2734)
                ->orWhere('g3c_terms.term_id', 2774)
                ->orWhere('g3c_terms.term_id', 2790)
                ->orWhere('g3c_terms.term_id', 2782)
                ->orWhere('g3c_terms.term_id', 2784)
                ->orWhere('g3c_terms.term_id', 2783)
                ->orWhere('g3c_terms.term_id', 2765)
                ->orWhere('g3c_terms.term_id', 2757)
                ->orWhere('g3c_terms.term_id', 2775)
                ->orWhere('g3c_terms.term_id', 2754)
                ->orWhere('g3c_terms.term_id', 2788)
                ->orWhere('g3c_terms.term_id', 2746)
                ->orWhere('g3c_terms.term_id', 2768)
                ->orWhere('g3c_terms.term_id', 2769)
                ->orWhere('g3c_terms.term_id', 2766)
                ->orWhere('g3c_terms.term_id', 2742)
                ->orWhere('g3c_terms.term_id', 2777)
                ->orWhere('g3c_terms.term_id', 2739)
                ->orWhere('g3c_terms.term_id', 2750)
                ->orWhere('g3c_terms.term_id', 2747)
                ->orWhere('g3c_terms.term_id', 2779)
                ->orWhere('g3c_terms.term_id', 2780)
                ->orWhere('g3c_terms.term_id', 2753)
                ->orWhere('g3c_terms.term_id', 2791);
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
