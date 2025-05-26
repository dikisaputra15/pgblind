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
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $actortypes = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('g3c_terms.term_id', 2522)
                ->orWhere('g3c_terms.term_id', 2507)
                ->orWhere('g3c_terms.term_id', 2555)
                ->orWhere('g3c_terms.term_id', 2553)
                ->orWhere('g3c_terms.term_id', 2554)
                ->orWhere('g3c_terms.term_id', 2557)
                ->orWhere('g3c_terms.term_id', 2556)
                ->orWhere('g3c_terms.term_id', 2492)
                ->orWhere('g3c_terms.term_id', 2491)
                ->orWhere('g3c_terms.term_id', 2490)
                ->orWhere('g3c_terms.term_id', 2495)
                ->orWhere('g3c_terms.term_id', 2499)
                ->orWhere('g3c_terms.term_id', 2494)
                ->orWhere('g3c_terms.term_id', 2497)
                ->orWhere('g3c_terms.term_id', 2496)
                ->orWhere('g3c_terms.term_id', 2498)
                ->orWhere('g3c_terms.term_id', 2552)
                ->orWhere('g3c_terms.term_id', 2545)
                ->orWhere('g3c_terms.term_id', 2542)
                ->orWhere('g3c_terms.term_id', 2546)
                ->orWhere('g3c_terms.term_id', 2551)
                ->orWhere('g3c_terms.term_id', 2548)
                ->orWhere('g3c_terms.term_id', 2550)
                ->orWhere('g3c_terms.term_id', 2549)
                ->orWhere('g3c_terms.term_id', 2544)
                ->orWhere('g3c_terms.term_id', 2547)
                ->orWhere('g3c_terms.term_id', 2501)
                ->orWhere('g3c_terms.term_id', 2503)
                ->orWhere('g3c_terms.term_id', 2502)
                ->orWhere('g3c_terms.term_id', 2504)
                ->orWhere('g3c_terms.term_id', 2487)
                ->orWhere('g3c_terms.term_id', 2482)
                ->orWhere('g3c_terms.term_id', 2484)
                ->orWhere('g3c_terms.term_id', 2485)
                ->orWhere('g3c_terms.term_id', 2483)
                ->orWhere('g3c_terms.term_id', 2480)
                ->orWhere('g3c_terms.term_id', 2481)
                ->orWhere('g3c_terms.term_id', 2856);
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
