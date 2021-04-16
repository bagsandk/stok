CREATE TYPE "typeenum" AS ENUM (
  'Yes',
  'No'
);

CREATE TYPE "typelevel" AS ENUM (
  'Super_Admin',
  'Administrator'
);

CREATE TABLE "users" (
  "user_id" uuid PRIMARY KEY NOT NULL,
  "first_name" varchar(50) NOT NULL,
  "last_name" varchar(50) NOT NULL,
  "mobile" varchar(15) NOT NULL,
  "email" varchar(50) NOT NULL,
  "password" varchar(75) NOT NULL,
  "isActive" typeenum NOT NULL,
  "profile" varchar(75) NOT NULL DEFAULT 'default.png',
  "level" typelevel NOT NULL,
  "publish" typeenum NOT NULL DEFAULT 'Yes',
  "create_at" timestamptz NOT NULL,
  "update_at" timestamptz NOT NULL,
  "delete_at" timestamptz NOT NULL
);
