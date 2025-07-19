<?php
// the table of deliveries are composed of: deliveryid, userid, courierid, origin, destination, packagedescription, status, deliverytimeestimate, createdat
return [
    [
        'origin' => 'Central Warehouse',
        'destination' => 'Azure Dragon Sect',
        'package_description' => 'Herbs Shipment',
        'weight_kg' => 15,
        'status' => 'Pending',
        'delivery_time_estimate' => '2 days',
    ],
    [
        'origin' => 'Central Warehouse',
        'destination' => 'White Tiger Sect',
        'package_description' => 'Weapons Delivery',
        'weight_kg' => 25,
        'status' => 'Delivered',
        'delivery_time_estimate' => '1 day',
    ],
    [
        'origin' => 'East Outpost',
        'destination' => 'Vermillion Bird Sect',
        'package_description' => 'Scrolls',
        'weight_kg' => 5,
        'status' => 'In Transit',
        'delivery_time_estimate' => '3 days',
    ],
    [
        'origin' => 'South Gate',
        'destination' => 'Black Tortoise Sect',
        'package_description' => 'Armor Parts',
        'weight_kg' => 10,
        'status' => 'Pending',
        'delivery_time_estimate' => '4 days',
    ],
];
