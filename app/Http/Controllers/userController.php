<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class userController extends Controller
{


    private function getUsersFilePath()
    { 
        return storage_path('app/users.json');
    }

    private function getUsers()
    {
        $path = $this->getUsersFilePath();

        if (!File::exists($path)) {
            return []; 
        }
        $content = File::get($path);
        $users = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($users)) {
            return [];
        }

        return $users;
    }
    private function saveUsers($users)
    {
        $path = $this->getUsersFilePath();
        $content = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        File::put($path, $content);
    }
    


    // public function index()
    // {
    //     $user=$this->getAllUser();

    //     return view('users.index',['users'=>$user]);
    // }

    public function index()
    {
        $users = $this->getUsers();
        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        $users=$this->getUsers();

        $user=collect($users)->firstWhere('id',$id);

        if(!$user)
        {
            abort(404);
        }
        return view('users.show',['user'=>$user]);
    }


    public function create()
    {
        return view('users.form');
    }


    public function store(Request $REQUEST)
    {
        $REQUEST->validate(
            [
                'name' => 'required|string|max:255',
                'email'=> 'required|email|max:255'
            ]
        );

        $users=$this->getUsers();

        $newUser=[
            'id'=> count($users)>0 ? max(array_column($users,'id')) + 1 : 1,
            'name' => $REQUEST->input('name'),
            'email' => $REQUEST->input('email')
        ];

        $users[] =$newUser;
        $this->saveUsers($users);

        return Redirect::route('users.index');
    }

    public function edit($id)
    {
        $users=$this->getUsers();

        $user=collect($users)->firstWhere('id',$id);

        if(!$user)
        {
            abort(404);
        }

        return view('users.form',['user'=>$user]);
    }

    public function update(Request $REQUEST,$id)
    {
        $users=$this->getUsers();

        $userindex=false;
       // $userindex=collect($users)->search(fn($user)=>$user['id']==$id);
        foreach($users as $key=>$user)
        {
            if($user['id']==$id)
            {
                $userindex=$key;
                break;
            }
        }

        if($userindex==false)
        {
            abort(404);
        }

        $users[$userindex]['name']=$REQUEST->input('name');
        $users[$userindex]['email']=$REQUEST->input('email');

        $this->saveUsers($users);

        return Redirect::route('users.index');
    }

    public function destroy($id)
    {
        $users=$this->getUsers();

        //$userindex=collect($users)->search(fn($user)=>$user['id']==$id);
        $userindex=false;
        foreach($users as $key=>$user)
        {
            if($user['id']==$id)
            {
                $userindex=$key;
                break;
            }
        }
        //dd($userindex);
        if($userindex==false)
        {
            abort(404);
        }
       unset($users[$userindex]);

       $this->saveUsers($users);

       return Redirect::route('users.index');

    }

}
