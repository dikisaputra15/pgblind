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

        $explosivetypes = DB::table('g3c_w2gm_locations_relationships')
        ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
        ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
        ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
        ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
        ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('g3c_terms.term_id', 3069)
                ->orWhere('g3c_terms.term_id', 3066)
                ->orWhere('g3c_terms.term_id', 3065)
                ->orWhere('g3c_terms.term_id', 3064)
                ->orWhere('g3c_terms.term_id', 3073)
                ->orWhere('g3c_terms.term_id', 3070)
                ->orWhere('g3c_terms.term_id', 3061)
                ->orWhere('g3c_terms.term_id', 3074)
                ->orWhere('g3c_terms.term_id', 3062)
                ->orWhere('g3c_terms.term_id', 3072)
                ->orWhere('g3c_terms.term_id', 3071)
                ->orWhere('g3c_terms.term_id', 3063)
                ->orWhere('g3c_terms.term_id', 3067)
                ->orWhere('g3c_terms.term_id', 3068);
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
