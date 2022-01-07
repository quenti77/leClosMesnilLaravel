<?php


namespace App\Transformer\Admin;

use App\Models\Booking;
use League\Fractal\TransformerAbstract;
use DateTime;

class BookingTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['user'];
    protected $defaultIncludes = ['user'];

    public function transform(Booking $booking): array
    {
        /** @var string $started */
        $started = $booking->started_at;
        $startedAt = new DateTime($started);
        /** @var string $finished */
        $finished = $booking->finished_at;
        $finishedAt = new DateTime($finished);
        /** @var string $payment */
        $payment = $booking->payment_at;
        $paymentAt = new DateTime($payment);

        return [
            'id' => $booking->id,
            'user_id' => $booking->user_id,
            'started_at' => $startedAt->format('d/m/Y'),
            'finished_at' => $finishedAt->format('d/m/Y'),
            'nb_adult' => $booking->nb_adult,
            'nb_children' => $booking->nb_children,
            'price' => $booking->price,
            'payment_at' => $paymentAt->format('d/m/Y')
        ];
    }

    public function includeUser(Booking $booking): \League\Fractal\Resource\Item
    {
        return $this->item($booking->user, new UserTransformer());
    }
}

