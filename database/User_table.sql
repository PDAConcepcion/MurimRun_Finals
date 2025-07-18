CREATE TABLE IF NOT EXISTS public."User_table" (
    user_id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    username varchar(254) NOT NULL,
    password varchar(254) NOT NULL,
    first_name varchar(254) NOT NULL,
    last_name varchar(254) NOT NULL,
    "role" varchar(254) NOT NULL,
    email varchar(254) NOT NULL,
    createdat date DEFAULT CURRENT_TIMESTAMP NOT NULL
);