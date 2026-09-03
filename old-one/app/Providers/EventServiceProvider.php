<?php

namespace App\Providers;

use App\Events\AppointmentBooked;
use App\Events\AppointmentStatusUpdated;
use App\Events\OrderPlaced;
use App\Events\OrderStatusUpdated;
use App\Listeners\SendAppointmentBookedNotifications;
use App\Listeners\SendAppointmentStatusNotification;
use App\Listeners\SendNewOrderAdminNotification;
use App\Listeners\SendOrderConfirmationEmail;
use App\Listeners\SendOrderPlacedCustomerNotification;
use App\Listeners\SendOrderStatusCustomerNotification;
use App\Listeners\SendOrderStatusUpdateEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [
            SendOrderConfirmationEmail::class,
            SendOrderPlacedCustomerNotification::class,
            SendNewOrderAdminNotification::class,
        ],
        OrderStatusUpdated::class => [
            SendOrderStatusUpdateEmail::class,
            SendOrderStatusCustomerNotification::class,
        ],
        AppointmentBooked::class => [
            SendAppointmentBookedNotifications::class,
        ],
        AppointmentStatusUpdated::class => [
            SendAppointmentStatusNotification::class,
        ],
    ];

    public function boot(): void {}

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
