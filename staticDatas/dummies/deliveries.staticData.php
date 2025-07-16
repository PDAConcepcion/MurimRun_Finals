<?php
// the table of deliveries are composed of: deliveryid, userid, courierid, origin, destination, packagedescription, status, deliverytimeestimate, createdat
return [
    [
        'origin' => 'Central Warehouse',
        'destination' => 'Azure Dragon Sect',
        'packagedescription' => 'Herbs Shipment',
        'weight_kg' => 15,
        'status' => 'Pending',
        'deliverytimeestimate' => '2 days',
    ],
    [
        'origin' => 'Central Warehouse',
        'destination' => 'White Tiger Sect',
        'packagedescription' => 'Weapons Delivery',
        'weight_kg' => 25,
        'status' => 'Delivered',
        'deliverytimeestimate' => '1 day',
    ],
    [
        'origin' => 'East Outpost',
        'destination' => 'Vermillion Bird Sect',
        'packagedescription' => 'Scrolls',
        'weight_kg' => 5,
        'status' => 'In Transit',
        'deliverytimeestimate' => '3 days',
    ],
    [
        'origin' => 'South Gate',
        'destination' => 'Black Tortoise Sect',
        'packagedescription' => 'Armor Parts',
        'weight_kg' => 10,
        'status' => 'Pending',
        'deliverytimeestimate' => '4 days',
    ],
];
