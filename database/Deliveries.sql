CREATE TABLE IF NOT EXISTS public."Deliveries_table" (
    delivery_id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id uuid NOT NULL,
    courier_id uuid NOT NULL,
    origin text NOT NULL,
    destination text,
    package_description text DEFAULT 'Pending',
    status text,
    delivery_time_estimate text,
    weight_kg int NOT NULL DEFAULT 0,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES "User_table"(user_id),
    FOREIGN KEY (courier_id) REFERENCES "SectCouriers_table"(courier_id)
);