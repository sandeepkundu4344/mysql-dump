<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artisan;
class TestController extends Controller
{
   
    /**
     * @param Request $request
     * @return string
     */
    public function download(Request $request)
    {
        
        Artisan::call("MysqlDump:run");
        dd("Please chec storage/mysqlbackups directory");
    }

   
}
