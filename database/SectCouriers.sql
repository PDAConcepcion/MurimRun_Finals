CREATE TABLE IF NOT EXISTS public."SectCouriers_table" (
    courier_id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
    name text NOT NULL,
    sectname text NOT NULL,
    rank varchar(254) NOT NULL,
    speedrating int,
    status text DEFAULT 'Available',
    image text
);