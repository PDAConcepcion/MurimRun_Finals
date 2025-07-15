Changes Preview
CREATE TABLE IF NOT EXISTS public."User_table" (
    userid uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    password varchar(254) NOT NULL,
    first_name varchar(254) NOT NULL,
    last_name varchar(254) NOT NULL,
    "role" varchar(254) NOT NULL,
    createdat date DEFAULT CURRENT_TIMESTAMP NOT NULL
);