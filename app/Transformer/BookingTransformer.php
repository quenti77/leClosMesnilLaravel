<?php


namespace App\Transformer;

use App\Models\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];
    protected $defaultIncludes = ['user'];

    public function transform(Booking $booking): array
    {
        $nb_voyager = $booking->nb_adult + $booking->nb_children;
        return [
            'id' => $booking->id,
            'user_id' => $booking->user_id,
            'started_at' => $booking->started_at,
            'finished_at' => $booking->finished_at,
            'nb_voyager' => $nb_voyager,
        ];
    }

    public function includeUser(Booking $booking): \League\Fractal\Resource\Item
    {
        return $this->item($booking->user, new UserTransformer());
    }
}

