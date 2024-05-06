<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ContactController extends Controller
{
    private function data()
    {
        if (!Cookie::has('contact'))
        {
            return [];
        }

        // Terima as JSON
        $data = Cookie::get('contact');
        $data = \json_decode($data);
        return $data;
    }

    public function View()
    {
        return \view('contact');
    }

    public function ActionContact(Request $request)
    {
        $data = $this->data();
        $d = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "message" => $request->input('message'),
        ];

        $data[] = $d;

        $data = \json_encode($data);
        $c = Cookie::make("contact", $data, 60*24*30);
        Cookie::queue($c);

        // dd($request->all());
        // dd(Cookie::get('contact'));
        // return 'Success';
        return redirect('/contact/list');
    }

    public function ContactList(Request $request)
    {
        // dd($request->cookie('contact'));
        $contacts = [];
        $contacts = json_decode($request->cookie('contact'), true);
        return \view('contact-list', [
            'contacts' => $contacts
        ]);
    }

    public function DeleteContact($index)
    {
        $data = $this->data();
        if (!is_array($data)) {
            $data = (array) $data;
        }
        unset($data[$index]);
        $jsonData = json_encode($data);
        $c = Cookie::make("contact", $jsonData, 60*24*30);
        return redirect('/contact/list')->withCookie($c);
    }
}
