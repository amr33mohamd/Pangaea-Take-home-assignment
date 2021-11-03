<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{

    public function subscribe(Request $request,$topic)
    {

        Validator::validate($request->all(), [
            "url" => [
                "required",
                "url",
                Rule::unique('subscribers')->where(function ($query) use($topic,$request) {
                    return $query->where('topic', $topic)->where('url', $request->url);
                })
            ]
        ]);

        //create new subscription
        $subscriber = Subscriber::create([
            'url' => $request->url,
            'topic' => $topic
        ]);
        $returnData = array(
            'status' => 'success',
            'message' => 'Subscribed Successfully'
        );
        return response()->json($returnData);


    }



}
