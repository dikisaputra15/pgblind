<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeapontypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $weapontypes = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('g3c_terms.term_id', 3056)
                ->orWhere('g3c_terms.term_id', 3058)
                ->orWhere('g3c_terms.term_id', 3047)
                ->orWhere('g3c_terms.term_id', 3053)
                ->orWhere('g3c_terms.term_id', 3049)
                ->orWhere('g3c_terms.term_id', 3046)
                ->orWhere('g3c_terms.term_id', 3051)
                ->orWhere('g3c_terms.term_id', 3054)
                ->orWhere('g3c_terms.term_id', 3050)
                ->orWhere('g3c_terms.term_id', 3059)
                ->orWhere('g3c_terms.term_id', 3052)
                ->orWhere('g3c_terms.term_id', 3048)
                ->orWhere('g3c_terms.term_id', 3055)
                ->orWhere('g3c_terms.term_id', 3057)
                ->orWhere('g3c_terms.term_id', 3060);
            })
        ->get();

        if($weapontypes->isNotEmpty()){
            foreach ($weapontypes as $weapontype){
                DB::table('pgstatistiks')
                    ->where('id_listing', $weapontype->id)
                    ->update([
                        'weapon_type' => $weapontype->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
