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
        // $tgl_coba = ['2024-08-29', '2024-08-31'];
        $icats = DB::table('g3c_terms')
            ->join('g3c_term_taxonomy', 'g3c_terms.term_id', '=', 'g3c_term_taxonomy.term_id')
            ->join('g3c_term_relationships', 'g3c_term_taxonomy.term_taxonomy_id', '=', 'g3c_term_relationships.term_taxonomy_id')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_term_relationships.object_id')
            ->join('g3c_w2gm_locations_relationships', 'g3c_posts.ID', '=', 'g3c_w2gm_locations_relationships.post_id')
            ->join('g3c_lokasi', 'g3c_w2gm_locations_relationships.location_id', '=', 'g3c_lokasi.lokasi_id')
            ->select('g3c_posts.ID', 'g3c_posts.post_title', 'g3c_w2gm_locations_relationships.id', 'g3c_w2gm_locations_relationships.address_line_1', 'g3c_lokasi.lokasi_name', 'g3c_lokasi.province_name', 'g3c_w2gm_locations_relationships.map_coords_1', 'g3c_w2gm_locations_relationships.map_coords_2', 'g3c_terms.name AS incident_category', 'g3c_w2gm_locations_relationships.number_of_incident', 'g3c_w2gm_locations_relationships.number_of_injuries', 'g3c_w2gm_locations_relationships.number_of_fatalities', 'g3c_w2gm_locations_relationships.additional_info', 'g3c_posts.post_date', 'g3c_terms.name')
            ->where('g3c_posts.post_status', 'publish')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('g3c_terms.term_id', 2558)
                      ->orWhere('g3c_terms.term_id', 2575)
                      ->orWhere('g3c_terms.term_id', 2630)
                      ->orWhere('g3c_terms.term_id', 2690)
                      ->orWhere('g3c_terms.term_id', 2636);
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
                    'article_link' => NULL,
                    'additional_info' => $icat->additional_info,
                    'date_posting' => $icat->post_date
                ];

                // DB::table('statistiks')->insert($category);
                $criteria = ['id_listing' => $icat->id];

              Pgstatistik::firstOrCreate(
                    $criteria,
                    $category
                );


            }
            echo "sukses";
        }else{
            echo "empty";
        }
    }
}
