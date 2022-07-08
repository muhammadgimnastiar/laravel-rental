<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Event;
use DB;
use App\Charts\UserChart;
class HomeController
{
    public function index()
    {
        // $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        //             ->whereYear('created_at', date('Y'))
        //             ->groupBy(DB::raw("Month(created_at)"))
        //             ->pluck('count', 'month_name');
 
        // $labels = $users->keys();
        // $data = $users->values();
        // return view('home', compact('labels', 'data'));

        // $users = User::select(\DB::raw("COUNT(*) as count"))
        //             ->whereYear('created_at', date('Y'))
        //             ->groupBy(\DB::raw("Month(created_at)"))
        //             ->pluck('count');

        // $chart = new UserChart;
        // $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        // $chart->dataset('New User Register Chart', 'line', $users)->options([
        //     'fill' => 'true',
        //     'borderColor' => '#51C1C0'
        // ]);

        $year = ['2018','2019','2020', '2021', '2022'];
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $user = [];
        $transaksi = [];

        foreach ($year as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

        foreach ($bulan as $key => $value) {
            $transaksi[] = Event::where(\DB::raw("DATE_FORMAT(start_time, '%b')"),$value)->count();
        }
        return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK))->with('bulan',json_encode($bulan,JSON_NUMERIC_CHECK))->with('transaksi',json_encode($transaksi,JSON_NUMERIC_CHECK));
    }
}

//2022-07-05 23:20:00
