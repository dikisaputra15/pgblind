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

        $regions = DB::table('g3c_postmeta')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_postmeta.post_id')
            ->join('g3c_w2gm_locations_relationships', 'g3c_w2gm_locations_relationships.post_id', '=', 'g3c_postmeta.post_id')
            ->select('g3c_postmeta.post_id', 'g3c_postmeta.meta_value', 'g3c_posts.post_date', 'g3c_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('g3c_postmeta.meta_key', '_content_field_118')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 11){
                    $reg = 'Business Entity';
                }elseif($region->meta_value == 12){
                    $reg = 'Foreign Government';
                }elseif($region->meta_value == 5){
                    $reg = 'Separatist Group';
                }elseif($region->meta_value == 3){
                    $reg = 'Central Government';
                }elseif($region->meta_value == 4){
                    $reg = 'Government Security Agency';
                }elseif($region->meta_value == 9){
                    $reg = 'Vested Interest/Stakeholder Group';
                }elseif($region->meta_value == 7){
                    $reg = 'Civilian';
                }elseif($region->meta_value == 1){
                    $reg = 'Local Government';
                }elseif($region->meta_value == 14){
                    $reg = 'Other';
                }elseif($region->meta_value == 8){
                    $reg = 'Community Group';
                }elseif($region->meta_value == 2){
                    $reg = 'Provincial Government';
                }elseif($region->meta_value == 13){
                    $reg = 'Unknown/ Unclaimed Responsibility';
                }elseif($region->meta_value == 10){
                    $reg = 'Crime Group';
                }else{
                    $reg = NULL;
                }
                DB::table('pgstatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'actor' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
