<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubactortypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $subactortypes = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('g3c_terms.term_id', 2527)
                ->orWhere('g3c_terms.term_id', 2529)
                ->orWhere('g3c_terms.term_id', 2530)
                ->orWhere('g3c_terms.term_id', 2617)
                ->orWhere('g3c_terms.term_id', 2532)
                ->orWhere('g3c_terms.term_id', 2533)
                ->orWhere('g3c_terms.term_id', 2531)
                ->orWhere('g3c_terms.term_id', 2528)
                ->orWhere('g3c_terms.term_id', 2509)
                ->orWhere('g3c_terms.term_id', 2511)
                ->orWhere('g3c_terms.term_id', 2522)
                ->orWhere('g3c_terms.term_id', 2514)
                ->orWhere('g3c_terms.term_id', 2515)
                ->orWhere('g3c_terms.term_id', 2512)
                ->orWhere('g3c_terms.term_id', 2513)
                ->orWhere('g3c_terms.term_id', 2518)
                ->orWhere('g3c_terms.term_id', 2519)
                ->orWhere('g3c_terms.term_id', 2516)
                ->orWhere('g3c_terms.term_id', 2517)
                ->orWhere('g3c_terms.term_id', 2520);
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
