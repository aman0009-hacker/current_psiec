<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;

class newupdatedcontroller extends Controller
{
    public function main()
    {
           
        if(\Auth::check())
        {
           $auth_id= \Auth::user()->id;
           $queryDocument = Attachment::where('user_id', $auth_id)->get();
          
           $gstValue = $msmeValue = $itrValue = $aadharValue = $panValue = $utilityValue = 0;
            foreach($queryDocument as $documentcheck)
            {
              
               if($documentcheck->fileno!==null && $documentcheck->file_type=="gstfile")
               {
                   $gstValue=1;
               }
               if($documentcheck->fileno!==null && $documentcheck->file_type=="msmefile")
               {
                  $msmeValue=1 ;
               }
               if($documentcheck->fileno!==null && $documentcheck->file_type=="itrfile")
               {
                  $itrValue=1;
               }
               if($documentcheck->fileno!==null && $documentcheck->file_type=="aadharfile")
               {
                   $aadharValue=1;
               }
               if($documentcheck->fileno==!null && $documentcheck->file_type=="panfile")
               {
                   $panValue=1;
               }
               if($documentcheck->fileno==!null && $documentcheck->utilityfile=="utilityfile")
               {
                   $utilityValue=1;
               }
               
            }
   
            $allValues=[
               "gstfile"=> $gstValue,
               "msmefile"=>$msmeValue,
               "itrfile"=>$itrValue,
               "aadharfile"=>$aadharValue,
               "panfile"=>$panValue,
               "utilityfile"=>$utilityValue,
            ];
            
        }
        else
        {
            $allValues=[
                "gstfile"=> 1,
                "msmefile"=>1,
                "itrfile"=>1,
                "aadharfile"=>1,
                "panfile"=>1,
                "utilityfile"=>1,
             ];
        }


        return view('components.document-process',compact('allValues'));
    }
}
