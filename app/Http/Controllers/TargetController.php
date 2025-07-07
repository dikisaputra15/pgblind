<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TargetController extends Controller
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
            ->where('g3c_postmeta.meta_key', '_content_field_130')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 34){
                    $reg = 'Activist Group';
                }elseif($region->meta_value == 22){
                    $reg = 'Mass Organization';
                }elseif($region->meta_value == 27){
                    $reg = 'Other community group';
                }elseif($region->meta_value == 52){
                    $reg = 'Asset/Site/Resource';
                }elseif($region->meta_value == 12){
                    $reg = 'Military - Air Force';
                }elseif($region->meta_value == 55){
                    $reg = 'Other Separatist Group';
                }elseif($region->meta_value == 3){
                    $reg = 'Central Government';
                }elseif($region->meta_value == 13){
                    $reg = 'Military - Air Force SF';
                }elseif($region->meta_value == 5){
                    $reg = 'Anti-Terror Police';
                }elseif($region->meta_value == 31){
                    $reg = 'Child/Youth/Student';
                }elseif($region->meta_value == 10){
                    $reg = 'Military - Army';
                }elseif($region->meta_value == 9){
                    $reg = 'Police - District-level Police';
                }elseif($region->meta_value == 50){
                    $reg = 'Country State-owned Enterprise (SOE)';
                }elseif($region->meta_value == 11){
                    $reg = 'Military - Army SF';
                }elseif($region->meta_value == 6){
                    $reg = 'Police - Mobile Brigade';
                }elseif($region->meta_value == 26){
                    $reg = 'Ethnic/Cultural Group';
                }elseif($region->meta_value == 16){
                    $reg = 'Military - Marine';
                }elseif($region->meta_value == 8){
                    $reg = 'Police - Municipality Police';
                }elseif($region->meta_value == 46){
                    $reg = 'Foreign Business/Enterprise';
                }elseif($region->meta_value == 17){
                    $reg = 'Military - Marine SF';
                }elseif($region->meta_value == 4){
                    $reg = 'Police - National Police';
                }elseif($region->meta_value == 54){
                    $reg = 'Foreign Government';
                }elseif($region->meta_value == 14){
                    $reg = 'Military - Navy';
                }elseif($region->meta_value == 7){
                    $reg = 'Police - Provincial Police';
                }elseif($region->meta_value == 29){
                    $reg = 'Foreign National';
                }elseif($region->meta_value == 15){
                    $reg = 'Military - Navy SF';
                }elseif($region->meta_value == 20){
                    $reg = 'Police Intelligence';
                }elseif($region->meta_value == 39){
                    $reg = 'Hard-line/Radicalized Islamic Group';
                }elseif($region->meta_value == 18){
                    $reg = 'Military - Special Operations Command';
                }elseif($region->meta_value == 37){
                    $reg = 'Political Party';
                }elseif($region->meta_value == 53){
                    $reg = 'Illegal Asset/Site/Resource';
                }elseif($region->meta_value == 21){
                    $reg = 'Military Intelligence';
                }elseif($region->meta_value == 40){
                    $reg = 'Political Party Supporter';
                }elseif($region->meta_value == 30){
                    $reg = 'Infant';
                }elseif($region->meta_value == 41){
                    $reg = 'Motorcycle Gang';
                }elseif($region->meta_value == 38){
                    $reg = 'Political Party Wing Group';
                }elseif($region->meta_value == 32){
                    $reg = 'International Activist Group/Organization';
                }elseif($region->meta_value == 49){
                    $reg = 'Multinational Corporation';
                }elseif($region->meta_value == 2){
                    $reg = 'Provincial Government';
                }elseif($region->meta_value == 44){
                    $reg = 'Large Business/Firms';
                }elseif($region->meta_value == 47){
                    $reg = 'National Conglomerate';
                }elseif($region->meta_value == 25){
                    $reg = 'Religious Group';
                }elseif($region->meta_value == 28){
                    $reg = 'Local Civilian';
                }elseif($region->meta_value == 48){
                    $reg = 'National Conglomerate - Multinational Corporation';
                }elseif($region->meta_value == 45){
                    $reg = 'Small or Medium Business/Firms';
                }elseif($region->meta_value == 24){
                    $reg = 'Local Community Group';
                }elseif($region->meta_value == 19){
                    $reg = 'National Intelligence';
                }elseif($region->meta_value == 36){
                    $reg = 'Union/ Labor Group';
                }elseif($region->meta_value == 42){
                    $reg = 'Local Criminal/Gang/Group';
                }elseif($region->meta_value == 35){
                    $reg = 'NGO';
                }elseif($region->meta_value == 33){
                    $reg = 'Vested Interest - Stakeholder';
                }elseif($region->meta_value == 43){
                    $reg = 'Organized Crime Group';
                }elseif($region->meta_value == 58){
                    $reg = 'Other';
                }elseif($region->meta_value == 1){
                    $reg = 'Local Government';
                }elseif($region->meta_value == 23){
                    $reg = 'Martial Arts Group';
                }elseif($region->meta_value == 51){
                    $reg = 'Other Business Entity';
                }elseif($region->meta_value == 61){
                    $reg = 'Unknown';
                }else{
                    $reg = NULL;
                }
                DB::table('pgstatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'target' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
