<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\devicehave;
use App\Models\History;
use App\Models\StateRelay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        if (Auth::user()->roles == 1) {
            $device = Device::all();
            return view('pages.dashboard.admin', compact('device'));
        } else {
            $device = devicehave::where('users', '=', Auth::user()->id)->get();
            return view('pages.dashboard.user', compact('device'));
        }
    }
    public function gethistoryfend()
    {

        if (request()->buttonstate) {
            //jika auto = 1 maka update matikan relay
            // ketika auto = 0 maka update relay yang di klik
            // dd(StateRelay::where('device_id', '=', request()->id)->first());
            if (StateRelay::where('device_id', '=', request()->id)->first()->Auto == 1 && request()->buttonstate[0] == 0) {
                StateRelay::where('device_id', '=', request()->id)->update([
                    'Auto' => request()->buttonstate[0],
                    'relay_1' => 0,
                    'relay_2' => 0,
                    'relay_3' => 0,
                    'relay_4' => 0,
                    'relay_5' => 0,
                    'relay_6' => 0,
                ]);
            } else {
                StateRelay::where('device_id', '=', request()->id)->update([
                    'Auto' => request()->buttonstate[0],
                    'relay_1' => request()->buttonstate[1],
                    'relay_2' => request()->buttonstate[2],
                    'relay_3' => request()->buttonstate[3],
                    'relay_4' => request()->buttonstate[4],
                    'relay_5' => request()->buttonstate[5],
                    'relay_6' => request()->buttonstate[6],

                ]);
            }


            $data20 = History::where('device_id', '=', request()->id)->orderBy('created_at', 'desc')->take(20)->get();
            $relay = StateRelay::where('device_id', '=', request()->id)->first();
            $suhu = [];
            $ph = [];
            $tds = [];
            $ketinggian_air = [];
            $created_at = [];
            $datarelay = [$relay->Auto, $relay->relaystate_1, $relay->relaystate_2, $relay->relaystate_3, $relay->relaystate_4, $relay->relaystate_5, $relay->relaystate_6];


            foreach ($data20 as $key => $value) {
                $suhu[$key] = $value->suhu;
                $ph[$key] = $value->ph;
                $tds[$key] = $value->tds;
                $ketinggian_air[$key] = $value->ketinggian_air;
                $created_at[$key] = $value->created_at;
            }
        }
        $relay = StateRelay::where('device_id', '=', request()->id)->first();
        $datarelay = [$relay->Auto, $relay->relaystate_1, $relay->relaystate_2, $relay->relaystate_3, $relay->relaystate_4, $relay->relaystate_5, $relay->relaystate_6];


        if (!request()->buttonstate) {
            return response()->json(['datarelay' => $datarelay]);
        }
        return response()->json(['suhu' => $suhu, 'ph' => $ph, 'tds' => $tds, 'ketinggian_air' => $ketinggian_air, 'created_at' => $created_at, 'datarelay' => $datarelay]);
    }
}
