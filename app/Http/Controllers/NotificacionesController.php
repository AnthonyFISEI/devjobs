<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $notificaciones=auth()->user()->unreadNotifications;
        // dd($notificaciones);

        //Restear notificaions
        auth()->user()->unreadNotifications->markAsRead();
        return view('notificaciones.index', compact('notificaciones'));
    }
}
