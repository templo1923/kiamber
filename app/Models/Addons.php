<?php

namespace DownGrade\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Addons extends Model
{
  
    
	
  public static function getaddonsViews()
  {

    $value=DB::table('addons')->orderBy('addon_id', 'desc')->get(); 
    return $value;
	
  }	
  
  
   public static function saveAddon($data)
   {
   
      DB::table('addons')->insert($data);
     
 
   }
   
   public static function checkAddon($addon_dir)
  {

    $get=DB::table('addons')->where('addon_dir','=',$addon_dir)->get(); 
    $value = $get->count();
	return $value;
	
  }
  
  
    public static function singleAddon($id)
    {

    $value=DB::table('addons')->where('addon_id','=',$id)->first(); 
    return $value;
	
    }	
	
	public static function updateAddon($id,$data)
	{
    DB::table('addons')
      ->where('addon_id', $id)
      ->update($data);
    }
	
	public static function deleteAddon($id)
	{
	   DB::table('addons')->where('addon_id', '=', $id)->delete();	
	}
	
	
  
}
