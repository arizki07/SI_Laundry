<?php

namespace App\Http\Controllers\_05_Setting;

use Carbon\Carbon;
use App\Models\User;
use App\Models\LogsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function logs()
    {
        $logs = LogsModel::orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view('products._05_Setting.logs', [
            'judul' => 'Log Activity',
            'active' => 'logs',
            'logs' => $logs,
            'users' => $users,
        ]);
    }

    public function destroy($id)
    {
        $logs = LogsModel::findOrFail($id);
        $logs->delete();
        if ($logs) {
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } else {
            return redirect()->back()->with('error', 'Data berhasil gagal di hapus');
        }
    }
}
