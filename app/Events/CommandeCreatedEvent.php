<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Commande;

class CommandeCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $commande;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Commande $commande)
    {
        //
        //return $commande;
        set_time_limit (300);
        if ($commande->code == null) {

            // * Get nom first 3 letters
            $client = "COM";
            // article exists
            if($commande->nom){
                $client = $commande->nom;
            }
            // uppercase
            $client = strtoupper($client);
            // take max 3 chars
            $limit = strlen($client) >= 3 ? 3 : strlen($client);
            $user = substr($client, 0, $limit);

            // remaining 5 digits
            $length = 4;
            $intMin = (10 ** $length) / 10;
        	$intMax = (10 ** $length) - 1;
        	$digits = mt_Rand($intMin, $intMax);
            //$digits = $commande->getDigits();
            $code = "$user$digits";
            $commande->code = $code;
            $commande ->save();
        }
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
