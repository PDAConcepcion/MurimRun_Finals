CREATE TABLE IF NOT EXISTS public."Deliveries_table" (
    deliveryid uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    userid uuid NOT NULL,
    courierid uuid NOT NULL,
    origin text NOT NULL,
    destination text,
    packagedescription text DEFAULT 'Pending',
    status text,
    deliverytimeestimate text,
    createdat timestamp DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (userid) REFERENCES "User_table"(userid),
    FOREIGN KEY (courierid) REFERENCES "SectCouriers_yable"(courierid)
);