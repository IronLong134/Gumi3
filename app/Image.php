<?php

namespace App;
use App\Comment;
use App\Like;
use App\Post;
use App\User;
use App\Friend;
use App\masterdata;
use App\Image;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table='images';
    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function addImage($new_image)
    {
        $user= Image::where('user_id','=',Auth::id())->count();
        if($user==0)
        {
            $image= new Image();
            $image->user_id=Auth::id();
            $image->images=$new_image;
            $image->save();
        }
        else
        {
            $old_images=Image::where('user_id','=',Auth::id())->pluck('images');
            $new_images=$old_images[0]." ".$new_image;
            //dd($new_images);
            Image::where('user_id','=',Auth::id())->update(['images'=>$new_images]);
        }
    }
    public function DeleteImage($images)
    {
        Image::where('user_id','=',Auth::id())->update(['images'=>$images]);
    }
}
