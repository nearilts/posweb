<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionDetailController extends Controller
{
   

    public function grafik_owner(Request $request) {

        $weekStartDate = now()->startOfWeek();
            $weekEndDate = now()->endOfWeek();
            
            $datas = Transaction::selectRaw('
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 1 THEN total ELSE 0 END) AS Minggu,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 2 THEN total ELSE 0 END) AS Senin,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 3 THEN total ELSE 0 END) AS Selasa,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 4 THEN total ELSE 0 END) AS Rabu,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 5 THEN total ELSE 0 END) AS Kamis,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 6 THEN total ELSE 0 END) AS Jumat,
                    SUM(CASE WHEN DAYOFWEEK(tanggal) = 7 THEN total ELSE 0 END) AS Sabtu
                ')
                ->whereBetween('tanggal', [$weekStartDate, $weekEndDate])
                ->first();
        
                
            $data['hari'] = array_keys($datas->toArray());
            $data['data'] = array_values($datas->toArray());
            $data['label'] = "Grafik Mingguan";

        $data['min'] = 1500000;
        $data['ids'] = 'myChart';
        
        return view('script_owner', $data);

    }


    
    public function grafik_owners(Request $request) {

           $now = Carbon::now();

            $weekStartDate = $now->startOfYear()->format('Y-m-d H:i:s');
            $weekEndDate = $now->endOfYear()->format('Y-m-d H:i:s');
            // ========================================================
            $level = "SELECT
            SUM(CASE WHEN  MONTH(a.tanggal) = 1 THEN a.total ELSE 0 END) January
            , SUM(CASE WHEN  MONTH(a.tanggal) = 2 THEN a.total ELSE 0 END) Feburary
            , SUM(CASE WHEN  MONTH(a.tanggal) = 3 THEN a.total ELSE 0 END) March
            , SUM(CASE WHEN  MONTH(a.tanggal) = 4 THEN a.total ELSE 0 END) April
            , SUM(CASE WHEN  MONTH(a.tanggal) = 5 THEN a.total ELSE 0 END) May
            , SUM(CASE WHEN  MONTH(a.tanggal) = 6 THEN a.total ELSE 0 END) June
            , SUM(CASE WHEN  MONTH(a.tanggal) = 7 THEN a.total ELSE 0 END) July
            , SUM(CASE WHEN  MONTH(a.tanggal) = 8 THEN a.total ELSE 0 END) August
            , SUM(CASE WHEN  MONTH(a.tanggal) = 9 THEN a.total ELSE 0 END) September
            , SUM(CASE WHEN  MONTH(a.tanggal) = 10 THEN a.total ELSE 0 END) October
            , SUM(CASE WHEN  MONTH(a.tanggal) = 11 THEN a.total ELSE 0 END) November
            , SUM(CASE WHEN  MONTH(a.tanggal) = 12 THEN a.total ELSE 0 END) December
            FROM
            transactions a
            WHERE
            a.tanggal BETWEEN '$weekStartDate' AND '$weekEndDate' 
            ";
            $level_data = DB::select($level);

            $Hari = [];
            $data = [];
            $no = 0;
            $nol = 0;
            foreach ($level_data[0] as $key => $valS) {
            $data['hari'][$nol++] =  $key;
            $data['data'][$no++] =  $valS;
            }
            // $data['hari'] = $array_date;
            $data['label'] = "Grafik Bulanan";
        $data['min'] = 1500000;
        $data['ids'] = 'myCharts';
        
        return view('script_owner', $data);

    }
}
