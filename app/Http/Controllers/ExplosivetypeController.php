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

        $regions = DB::table('g3c_postmeta')
            ->join('g3c_posts', 'g3c_posts.ID', '=', 'g3c_postmeta.post_id')
            ->join('g3c_w2gm_locations_relationships', 'g3c_w2gm_locations_relationships.post_id', '=', 'g3c_postmeta.post_id')
            ->select('g3c_postmeta.post_id', 'g3c_postmeta.meta_value', 'g3c_posts.post_date', 'g3c_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(g3c_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(g3c_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('g3c_postmeta.meta_key', '_content_field_117')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'Air strike';
                }elseif($region->meta_value == 6){
                    $reg = 'Fish Bomb';
                }elseif($region->meta_value == 11){
                    $reg = 'Landmine';
                }elseif($region->meta_value == 2){
                    $reg = 'Artillery';
                }elseif($region->meta_value == 7){
                    $reg = 'Grenade Launchers';
                }elseif($region->meta_value == 12){
                    $reg = 'MANPAD';
                }elseif($region->meta_value == 3){
                    $reg = 'Car Bomb/VBIED';
                }elseif($region->meta_value == 8){
                    $reg = 'Grenades';
                }elseif($region->meta_value == 13){
                    $reg = 'Military-grade Explosives';
                }elseif($region->meta_value == 4){
                    $reg = 'Commercial Explosives';
                }elseif($region->meta_value == 9){
                    $reg = 'Homemade Explosives';
                }elseif($region->meta_value == 14){
                    $reg = 'Naval Bombardment';
                }elseif($region->meta_value == 5){
                    $reg = 'Firebomb';
                }elseif($region->meta_value == 10){
                    $reg = 'Improvised Explosive Devices (IEDs)';
                }else{
                    $reg = NULL;
                }
                DB::table('pgstatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'explosive_type' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
