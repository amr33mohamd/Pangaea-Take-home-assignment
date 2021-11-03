<?php

namespace App\Http\Controllers;

use App\Jobs\TopicSend;
use App\Models\Subscriber;
use App\Models\Topic;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic)
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$topic)
    {
        if(!empty($request->all())){
            $subscribers = Subscriber::query()->where('topic',$topic)->get();
            foreach ($subscribers as $subscriber){
                dispatch(new TopicSend($subscriber->url,$topic,$request->all()))->delay(now()->addMinutes(1));
            }
            $returnData = array(
                'status' => 'Success',
                'message' => 'Data Sent'
            );
            return response()->json($returnData, 200);

        }
        else{
            $returnData = array(
                'status' => 'error',
                'message' => 'No Content'
            );
            return response()->json($returnData, 500);
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
    public function update(Request $request,$topic)
    {


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
