<?php

namespace App\Jobs;
use Illuminate\Support\Facades\Http;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TopicSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $topic;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url,$topic,$data)
    {
        $this->url = $url;
        $this->topic = $topic;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::post($this->url, [
            'topic' => $this->topic,
            'data'=>$this->data
        ]);
    }
}
