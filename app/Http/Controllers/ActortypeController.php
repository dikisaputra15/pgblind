<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActortypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-02-01', '2024-02-10'];

        $actortypes = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 2522)
                ->orWhere('wp_terms.term_id', 2507)
                ->orWhere('wp_terms.term_id', 2555)
                ->orWhere('wp_terms.term_id', 2553)
                ->orWhere('wp_terms.term_id', 2554)
                ->orWhere('wp_terms.term_id', 2557)
                ->orWhere('wp_terms.term_id', 2556)
                ->orWhere('wp_terms.term_id', 2492)
                ->orWhere('wp_terms.term_id', 2491)
                ->orWhere('wp_terms.term_id', 2490)
                ->orWhere('wp_terms.term_id', 2495)
                ->orWhere('wp_terms.term_id', 2499)
                ->orWhere('wp_terms.term_id', 2494)
                ->orWhere('wp_terms.term_id', 2497)
                ->orWhere('wp_terms.term_id', 2496)
                ->orWhere('wp_terms.term_id', 2498)
                ->orWhere('wp_terms.term_id', 2552)
                ->orWhere('wp_terms.term_id', 2545)
                ->orWhere('wp_terms.term_id', 2542)
                ->orWhere('wp_terms.term_id', 2546)
                ->orWhere('wp_terms.term_id', 2551)
                ->orWhere('wp_terms.term_id', 2548)
                ->orWhere('wp_terms.term_id', 2550)
                ->orWhere('wp_terms.term_id', 2549)
                ->orWhere('wp_terms.term_id', 2544)
                ->orWhere('wp_terms.term_id', 2547)
                ->orWhere('wp_terms.term_id', 2501)
                ->orWhere('wp_terms.term_id', 2503)
                ->orWhere('wp_terms.term_id', 2502)
                ->orWhere('wp_terms.term_id', 2504)
                ->orWhere('wp_terms.term_id', 2487)
                ->orWhere('wp_terms.term_id', 2482)
                ->orWhere('wp_terms.term_id', 2484)
                ->orWhere('wp_terms.term_id', 2485)
                ->orWhere('wp_terms.term_id', 2483)
                ->orWhere('wp_terms.term_id', 2480)
                ->orWhere('wp_terms.term_id', 2481)
                ->orWhere('wp_terms.term_id', 2856);
            })
        ->get();

        if($actortypes->isNotEmpty()){
            foreach ($actortypes as $actortype){
                DB::table('pgstatistiks')
                    ->where('id_listing', $actortype->id)
                    ->update([
                        'actor_type' => $actortype->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
