<?php

namespace App\Http\Controllers;

use App\Models\Pgstatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-02-01', '2024-02-10'];
        $icats = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_term_relationships', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_term_relationships.object_id')
            ->join('wp_w2gm_locations_relationships', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->join('wp_lokasi', 'wp_w2gm_locations_relationships.location_id', '=', 'wp_lokasi.lokasi_id')
            ->select('wp_posts.ID', 'wp_posts.post_title', 'wp_w2gm_locations_relationships.id', 'wp_w2gm_locations_relationships.address_line_1', 'wp_lokasi.lokasi_name', 'wp_lokasi.province_name', 'wp_w2gm_locations_relationships.map_coords_1', 'wp_w2gm_locations_relationships.map_coords_2', 'wp_terms.name AS incident_category', 'wp_w2gm_locations_relationships.number_of_incident', 'wp_w2gm_locations_relationships.number_of_injuries', 'wp_w2gm_locations_relationships.number_of_fatalities', 'wp_w2gm_locations_relationships.additional_info', 'wp_posts.post_date', 'wp_terms.name')
            ->where('wp_posts.post_status', 'publish')
            ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2558)
                      ->orWhere('wp_terms.term_id', 2575)
                      ->orWhere('wp_terms.term_id', 2630)
                      ->orWhere('wp_terms.term_id', 2690)
                      ->orWhere('wp_terms.term_id', 2636);
            })
            ->get();

            // $no = 1;
            // foreach ($icats as $icat) {
            //     echo $no++ . " " . $icat->ID . " " . $icat->id . " " . $icat->post_title . "<br>";
            // }    

        if($icats->isNotEmpty()){
            foreach ($icats as $icat){
                $loc = $icat->map_coords_1 . "," . " " . $icat->map_coords_2;
                $category = [
                    'id_listing' => $icat->id,
                    'post_id_cat' => $icat->ID,
                    'listing_date' => NULL,
                    'post_title' => $icat->post_title,
                    'address' => $icat->address_line_1,
                    'regency_city' => $icat->lokasi_name,
                    'province_name' => $icat->province_name,
                    'country' => 'Papua New Guinea',
                    'location' => $loc,
                    'main_incident' => $icat->name,
                    'incident_category' => NULL,
                    'incident_type' => NULL,
                    'sub_incident_type' => NULL,
                    'weapon_type' => NULL,
                    'explosive_type' => NULL,
                    'actor' => NULL,
                    'actor_type' => NULL,
                    'sub_actor_type' => NULL,
                    'target' => NULL,
                    'target_type' => NULL,
                    'violence' => NULL,
                    'number_of_incident' => $icat->number_of_incident,
                    'number_of_injuries' => $icat->number_of_injuries,
                    'number_of_fatalities' => $icat->number_of_fatalities,
                    'additional_info' => $icat->additional_info,
                    'date_posting' => $icat->post_date
                ];

                // DB::table('statistiks')->insert($category);
                $criteria = ['id_listing' => $icat->id];

              $inp = Pgstatistik::firstOrCreate(
                    $criteria,
                    $category
                );

                
                if($inp){
                    DB::table('indostatistiknews')
                        ->where('id_listing', '!=', $icat->id)
                        ->where('post_id_cat', '=', $icat->ID)
                        ->delete();
                }

            }
            echo "sukses";
        }else{
            echo "empty";
        }
    }
}
