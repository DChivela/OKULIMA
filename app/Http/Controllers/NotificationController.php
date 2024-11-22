<?php


namespace App\Http\Controllers;

use App\Models\AgendamentoNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function index(Request $request)
  {
      // You can customize this to fetch only the authenticated user's notifications
      $notifications = AgendamentoNotification::where('user_id', auth()->id())
          ->orderBy('created_at', 'desc') // Optional: Order notifications
          ->get();

      return response()->json($notifications);
  }
}