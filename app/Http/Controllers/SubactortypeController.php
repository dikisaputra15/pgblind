<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubactortypeController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-08-29', '2024-08-31'];

        $subactortypes = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 2527)
                ->orWhere('wp_terms.term_id', 2529)
                ->orWhere('wp_terms.term_id', 2530)
                ->orWhere('wp_terms.term_id', 2617)
                ->orWhere('wp_terms.term_id', 2532)
                ->orWhere('wp_terms.term_id', 2533)
                ->orWhere('wp_terms.term_id', 2531)
                ->orWhere('wp_terms.term_id', 2528)
                ->orWhere('wp_terms.term_id', 2509)
                ->orWhere('wp_terms.term_id', 2511)
                ->orWhere('wp_terms.term_id', 2522)
                ->orWhere('wp_terms.term_id', 2514)
                ->orWhere('wp_terms.term_id', 2515)
                ->orWhere('wp_terms.term_id', 2512)
                ->orWhere('wp_terms.term_id', 2513)
                ->orWhere('wp_terms.term_id', 2518)
                ->orWhere('wp_terms.term_id', 2519)
                ->orWhere('wp_terms.term_id', 2516)
                ->orWhere('wp_terms.term_id', 2517)
                ->orWhere('wp_terms.term_id', 2520);
            })
        ->get();

        if($subactortypes->isNotEmpty()){
            foreach ($subactortypes as $subactortype){
                DB::table('pgstatistiks')
                    ->where('id_listing', $subactortype->id)
                    ->update([
                        'sub_actor_type' => $subactortype->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
