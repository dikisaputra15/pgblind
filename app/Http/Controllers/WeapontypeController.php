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
        // $tgl_coba = ['2024-02-01', '2024-02-10'];

        $weapontypes = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 3056)
                ->orWhere('wp_terms.term_id', 3058)
                ->orWhere('wp_terms.term_id', 3047)
                ->orWhere('wp_terms.term_id', 3053)
                ->orWhere('wp_terms.term_id', 3049)
                ->orWhere('wp_terms.term_id', 3046)
                ->orWhere('wp_terms.term_id', 3051)
                ->orWhere('wp_terms.term_id', 3054)
                ->orWhere('wp_terms.term_id', 3050)
                ->orWhere('wp_terms.term_id', 3059)
                ->orWhere('wp_terms.term_id', 3052)
                ->orWhere('wp_terms.term_id', 3048)
                ->orWhere('wp_terms.term_id', 3055)
                ->orWhere('wp_terms.term_id', 3057)
                ->orWhere('wp_terms.term_id', 3060);
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
