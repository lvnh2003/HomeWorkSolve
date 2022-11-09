<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Post;
use App\Models\React;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class InterFaceController extends Controller
{
  public function index(Request $request)
  {
    
    $search=$request->get('searchPost');
    
    $posts = Post::where('isActive', 1)
    ->where('caption','like', '%' . $search . '%')
    ->orWhere('content','like', '%' . $search . '%')
    ->orderBy('id','DESC')->paginate(3);
  
    return view('users.index',['posts' => $posts]);


  }
  public function search()
  {

    return view('users.search');
  }
  public function apiName(Request $rq)
  {

    return User::where('name', 'like', '%' . $rq->get('q') . '%')
    ->whereHas('infoLogin',function($query){
      $query->where('role',1);
    })
      ->get([
        'id',
        'name',
        'avatar'

      ]);
      
  }
  public function getUserSearch()
  {
    $user=User::whereHas('infoLogin',function($query){
      $query->where('role',1);
    })->get();
    
    return DataTables::of($user)
      
      ->addColumn('detail', function (User $object) {
        return route('detail', $object->id);
      })
      ->addColumn('avatar',function(User $user){
        return $user->getAvatar();
      })
      ->rawColumns(['detail'])
      ->make(true);
  }
  public function detail($id)
  {
    $user = User::find($id);
    
    
    $posts = Post::where('idUsers', $user->id)
      ->where('isActive', 0)
      ->get();
    $react = React::where('idUsers', $id)->get();


    return view('users.user.profile', ['user' => $user, 'posts' => $posts, 'reacts' => $react]);
  }
  public function contact(){
    return view('users.contact');
  }
}
