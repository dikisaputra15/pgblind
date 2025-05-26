<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActorController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-10-14', '2024-10-15'];

        $actors = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        // ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('g3c_terms.term_id', 2535)
                ->orWhere('g3c_terms.term_id', 2537)
                ->orWhere('g3c_terms.term_id', 2488)
                ->orWhere('g3c_terms.term_id', 2506)
                ->orWhere('g3c_terms.term_id', 2538)
                ->orWhere('g3c_terms.term_id', 2539)
                ->orWhere('g3c_terms.term_id', 2489)
                ->orWhere('g3c_terms.term_id', 2493)
                ->orWhere('g3c_terms.term_id', 2541)
                ->orWhere('g3c_terms.term_id', 2500)
                ->orWhere('g3c_terms.term_id', 2479)
                ->orWhere('g3c_terms.term_id', 2505)
                ->orWhere('g3c_terms.term_id', 2540)
                ->orWhere('g3c_terms.term_id', 2536);
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
