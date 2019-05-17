<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Masterdata extends Model {//
        protected $table = 'masterdata';
        
        public function getBloodName($value) {
            
            if ($value!==NULL) {
                //dd($value);
                $name = Masterdata::where('value', '=', $value)->where('kind', '=', '0')->where('delete_at', '=', 0)->first();
    
                return $name->name;
    
            }
            else
            {
                $a = NULL;
                return $a;
            }
            
        }
        
        public function getAllBlood() {
            $all = Masterdata::where('kind', '=', '0')->where('delete_at', '=', 0)->get();
            
            return $all;
        }
    }
