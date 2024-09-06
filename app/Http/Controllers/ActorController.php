<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActorController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $actors = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 2535)
                ->orWhere('wp_terms.term_id', 2537)
                ->orWhere('wp_terms.term_id', 2488)
                ->orWhere('wp_terms.term_id', 2506)
                ->orWhere('wp_terms.term_id', 2538)
                ->orWhere('wp_terms.term_id', 2539)
                ->orWhere('wp_terms.term_id', 2489)
                ->orWhere('wp_terms.term_id', 2493)
                ->orWhere('wp_terms.term_id', 2541)
                ->orWhere('wp_terms.term_id', 2500)
                ->orWhere('wp_terms.term_id', 2479)
                ->orWhere('wp_terms.term_id', 2505)
                ->orWhere('wp_terms.term_id', 2540)
                ->orWhere('wp_terms.term_id', 2536);
            })
        ->get();

        if($actors->isNotEmpty()){
            foreach ($actors as $actor){
                DB::table('pgstatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'actor' => $actor->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
