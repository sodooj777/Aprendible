<?php

namespace App\Events;


use App\Project; //importamos este modelo project
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $project; // es inportante que la propiedad sea publica 
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)//podemos obligar que sea una instancia del modelo project importamos esta modelo project
    {
        // es inportante que la propiedad sea publica  para poderla usar en el listenner y podemso obligar q sea una instancia del modelo project
        $this->project = $project;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
