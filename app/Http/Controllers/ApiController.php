<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    // return list of all key value
    public function index(Request $request)
    {
        $redis = app()->make('redis'); 

        $keys_to_find = $request->all(); 

        $finderArray = array(); 
        
        $set =  array(); 

        // specific key find 
        if(isset($keys_to_find["keys"])){
            $plain_keys = $keys_to_find["keys"]; 
            $finderArray = explode(',', $plain_keys);

            foreach($finderArray as $key){
                $value = $redis->get($key); 
                $set[$key] = $value; 
                $redis->set($key, $value, 'EX', 300);  // Reset TTL 
            }


        }
       
        // retrieve list of all key values. 
        else if(empty($keys_to_find)){
            $finderArray = $redis->keys('*');  

            foreach($finderArray as $key){
                $prefix = env('PREDIS_PREFIX', 'laravel_database_'); 
                $key = str_replace($prefix, "", $key); // removing prefix from redis key
                $value = $redis->get($key); 
                $set[$key] = $value; 
                $redis->set($key, $value, 'EX', 300); // Reset TTL 
            }

        }

        $data["status"] = "OK"; 
        $data["count"] = count($set); 
        $data["data"] = $set; 

        return response()->json($data); 
    }


    // save new key value (POST)
    public function store(Request $request){
        
        $redis = app()->make('redis'); 
        $received_data = $request->getContent();
        $data_obj = json_decode($received_data);
        $result_arr = array(); 
      
        if(!empty($data_obj)){
            foreach($data_obj as $key=>$value){

                if($redis->set($key, $value, 'EX', 300))
                { 
                    $result_arr[$key]=$value; 
                }
            }
   
        }

        $data["status"] = "OK"; 
        $data["inserted"] = count($result_arr); 
        $data["data"] = $result_arr; 

        return response()->json($data);
    }

    // update existing key (if exist, PATCH)
    public function update(Request $request){
        $redis = app()->make('redis'); 
        $received_data = $request->getContent();
        $data_obj = json_decode($received_data);
        $result_arr = array(); 

        if(!empty($data_obj)){
            foreach($data_obj as $key=>$value){

                if($redis->exists($key))
                { 

                    $result_arr[$key]=$value;
                    $redis->set($key, $value, 'EX', 300); // Update Value 
                } 
            }

            $data["status"] = "OK"; 
            $data["updated_count"] = count($result_arr); 
            $data["data"] = $result_arr; 
            
            return response()->json($data);
        }

    }


    

    
}
