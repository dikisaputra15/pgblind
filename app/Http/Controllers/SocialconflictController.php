<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SocialconflictController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-08-29', '2024-08-31'];

        $sconflicts = DB::table('g3c_w2gm_locations_relationships')
            ->join('g3c_term_relationships', 'g3c_term_relationships.object_id', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->join('g3c_term_taxonomy', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
            ->join('g3c_terms', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->select('g3c_w2gm_locations_relationships.id', 'g3c_terms.name')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('g3c_terms.term_id', 2609)
                        ->orWhere('g3c_terms.term_id', 2611)
                        ->orWhere('g3c_terms.term_id', 2608)
                        ->orWhere('g3c_terms.term_id', 2606)
                        ->orWhere('g3c_terms.term_id', 2607)
                        ->orwhere('g3c_terms.term_id', 2610)
                        ->orwhere('g3c_terms.term_id', 2603)
                        ->orwhere('g3c_terms.term_id', 2604)
                        ->orwhere('g3c_terms.term_id', 2601)
                        ->orwhere('g3c_terms.term_id', 2605)
                        ->orwhere('g3c_terms.term_id', 2602);
                     })
            ->get();

            if($sconflicts->isNotEmpty()){
                foreach ($sconflicts as  $sconflict){
                    DB::table('pgstatistiks')
                        ->where('id_listing', $sconflict->id)
                        ->update([
                            'sub_incident_type' => $sconflict->name
                        ]);
                }
                echo "sukses";
            }else{
                echo "empty";
            }

    }
}
