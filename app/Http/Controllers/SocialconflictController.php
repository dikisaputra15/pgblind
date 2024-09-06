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

        $sconflicts = DB::table('wp_w2gm_locations_relationships')
            ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
            ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
            ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2609)
                        ->orWhere('wp_terms.term_id', 2611)
                        ->orWhere('wp_terms.term_id', 2608)
                        ->orWhere('wp_terms.term_id', 2606)
                        ->orWhere('wp_terms.term_id', 2607)
                        ->orwhere('wp_terms.term_id', 2610)
                        ->orwhere('wp_terms.term_id', 2603)
                        ->orwhere('wp_terms.term_id', 2604)
                        ->orwhere('wp_terms.term_id', 2601)
                        ->orwhere('wp_terms.term_id', 2605)
                        ->orwhere('wp_terms.term_id', 2602);
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
