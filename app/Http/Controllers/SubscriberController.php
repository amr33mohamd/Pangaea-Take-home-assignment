<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$topic)
    {

        $validator =  Validator::make($request->all(), [
            "url"    => "required|url",
        ]);
        if ($validator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => $validator->messages()
            );
            return response()->json( $returnData,500);
        } else {
            $subscribers = Subscriber::query()->where([
                'url' => $request->url,
                'topic' => $topic
            ]);
            if ($subscribers->count() >= 1) {
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Subscribed Before'
                );
                return response()->json($returnData, 500);
            } else {
                $subscriber = Subscriber::create([
                    'url' => $request->url,
                    'topic' => $topic
                ]);
                $returnData = array(
                    'status' => 'success',
                    'message' => 'Subscribed Successfully'
                );
                return response()->json($returnData, 200);

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
