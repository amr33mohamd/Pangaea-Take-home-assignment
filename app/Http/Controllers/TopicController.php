<?php

namespace App\Http\Controllers;

use App\Jobs\TopicSend;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function publish(Request $request,$topic)
    {
        if(empty($request->all())){
            $returnData = array(
                'status' => 'error',
                'message' => 'No Content'
            );
            return response()->json($returnData, 400);
        }

        $subscribers = Subscriber::query()->where('topic',$topic)->get();
        foreach ($subscribers as $subscriber){
            dispatch(new TopicSend($subscriber->url,$topic,$request->all()));
        }
        $returnData = array(
            'status' => 'Success',
            'message' => 'Data Sent'
        );
        return response()->json($returnData);


    }


}
