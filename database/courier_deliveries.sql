CREATE TABLE IF NOT EXISTS public."courier_deliveries" (
    courierid uuid NOT NULL REFERENCES "SectCouriers_yable"(courierid),
    deliveryid uuid NOT NULL REFERENCES "Deliveries_table"(deliveryid),
    PRIMARY KEY (courierid, deliveryid)
);
