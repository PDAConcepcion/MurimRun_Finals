CREATE TABLE IF NOT EXISTS public."courier_deliveries" (
    courier_id uuid NOT NULL REFERENCES "SectCouriers_table"(courier_id),
    delivery_id uuid NOT NULL REFERENCES "Deliveries_table"(delivery_id),
    PRIMARY KEY (courier_id, delivery_id)
);
