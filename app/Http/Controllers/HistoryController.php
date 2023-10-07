<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\History;
use App\Models\StateRelay;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //

    public function index()
    {
        $device = Device::all();
        $history = History::all();
        return view('pages.history.index', compact('device', 'history'));
    }
    public function logdevice()
    {
        $device = Device::where('nama_device', '=', request()->nama_device)->first();
        if ($device != null) {
            StateRelay::where('device_id', '=', $device->id)->update([
                'relaystate_1' => request()->relaystate_1,
                'relaystate_2' => request()->relaystate_2,
                'relaystate_3' => request()->relaystate_3,
                'relaystate_4' => request()->relaystate_4,
                'relaystate_5' => request()->relaystate_5,
                'relaystate_6' => request()->relaystate_6,
            ]);
            History::create([
                'device_id' => $device->id,
                'suhu' => request()->suhu,
                'ph' => request()->ph,
                'tds' => request()->tds,
                'ketinggian_air' => request()->ketinggian_air,
            ]);
            $dataRelay = StateRelay::where('device_id', '=', $device->id)->first();
            return response()->json([
                'message' => "Success",
                'relaystate' => $dataRelay->Auto . $dataRelay->relay_1 . $dataRelay->relay_2 . $dataRelay->relay_3 . $dataRelay->relay_4 . $dataRelay->relay_5 . $dataRelay->relay_6,
                // respon mulai dari Auto , relay_1, relay_2, dst
            ]);
        } else {
            return response()->json([
                'message' => "ERROR",
            ]);
        }
    }
    public function history()
    {
        // dd(request()->all());
        if (request()->device == "0") {

            if (request()->startdate != null && request()->enddate != null) {
                $history = History::where('created_at', '>=', request()->startdate)->where('created_at', '<=', request()->enddate)->get();
                foreach ($history as $key => $value) {
                    $data[$key] = $value;
                    $data[$key]['device'] = $value->device;
                }
                return response()->json([
                    'message' => "Success",
                    'history' => $data,
                ]);
            } else {
                // dd('hello');
                $history = History::all();
                $data = [];
                foreach ($history as $key => $value) {
                    $data[$key] = $value;
                    $data[$key]['device'] = $value->device;
                }
                return response()->json([
                    'message' => "Success",
                    'history' => $data,
                ]);
            }
            $history = History::all();
            foreach ($history as $key => $value) {
                $data[$key] = $value;
                $data[$key]['device'] = $value->device;
            }
            return response()->json([
                'message' => "Success",
                'history' => $data,
            ]);
        } else {
            if (request()->startdate != null && request()->enddate != null) {
                $history = History::where('device_id', '=', request()->device)->where('created_at', '>=', request()->startdate)->where('created_at', '<=', request()->enddate)->get();
                $data = [];
                foreach ($history as $key => $value) {
                    $data[$key] = $value;
                    $data[$key]['device'] = $value->device;
                }
                return response()->json([
                    'message' => "Success",
                    'history' => $data,
                ]);
            } else {
                $history = History::where('device_id', '=', request()->device)->get();

                foreach ($history as $key => $value) {
                    $data[$key] = $value;
                    $data[$key]['device'] = $value->device;
                }
                return response()->json([
                    'message' => "Success",
                    'history' => $data,
                ]);
            }
        }
    }
}
