<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {

        return view('admin.notification.index');
    }
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications->where('id', $id)->first();
        $notification->markAsRead();
    }

    public function destroy($id)
    {

        $user = Auth::user();
        $notification = $user->notifications->where('id', $id)->first();
        $notification->delete();

        return redirect()->back()->with('success', 'notifaction deleted successfully');
    }


    public function deleteAll()
    {
        foreach (Auth::user()->notifications as $notification) {
            $notification->delete();
        }
        return redirect()->back()->with('success', 'All Notifications deleted successfully!');
    }

    public function deleteReaded()
    {
        foreach (Auth::user()->readNotifications as $notification) {
            $notification->delete();
        }
        return redirect()->back()->with('success', 'readed Notifications deleted successfully!');
    }
}