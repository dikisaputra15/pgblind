<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExplosivetypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $explosivetypes = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 3069)
                ->orWhere('wp_terms.term_id', 3066)
                ->orWhere('wp_terms.term_id', 3065)
                ->orWhere('wp_terms.term_id', 3064)
                ->orWhere('wp_terms.term_id', 3073)
                ->orWhere('wp_terms.term_id', 3070)
                ->orWhere('wp_terms.term_id', 3061)
                ->orWhere('wp_terms.term_id', 3074)
                ->orWhere('wp_terms.term_id', 3062)
                ->orWhere('wp_terms.term_id', 3072)
                ->orWhere('wp_terms.term_id', 3071)
                ->orWhere('wp_terms.term_id', 3063)
                ->orWhere('wp_terms.term_id', 3067)
                ->orWhere('wp_terms.term_id', 3068);
            })
        ->get();

        if($explosivetypes->isNotEmpty()){
            foreach ($explosivetypes as  $explosivetype){
                DB::table('pgstatistiks')
                    ->where('id_listing', $explosivetype->id)
                    ->update([
                        'explosive_type' => $explosivetype->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }
    }
}
