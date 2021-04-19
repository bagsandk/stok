CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE TYPE "typeenum" AS ENUM (
  'Yes',
  'No'
);

CREATE TYPE "history_type" AS ENUM (
  'Select',
  'Insert',
  'Update',
  'Delete'
);

CREATE TYPE "typelevel" AS ENUM (
  'Super_Admin',
  'Administrator',
  'Guest'
);

CREATE TABLE "users" (
  "user_id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "first_name" varchar(50) NOT NULL,
  "last_name" varchar(50) NOT NULL,
  "mobile" varchar(15) NOT NULL,
  "email" varchar(50) NOT NULL,
  "password" varchar(75) NOT NULL,
  "isActive" typeenum NOT NULL,
  "profile" varchar(75) NOT NULL DEFAULT 'default.png',
  "level" typelevel NOT NULL,
  "publish" typeenum NOT NULL DEFAULT 'Yes',
  "create_at" timestamptz NOT NULL DEFAULT (now()),
  "update_at" timestamptz NOT NULL DEFAULT (now()),
  "delete_at" timestamptz NOT NULL DEFAULT (now())
);

CREATE TABLE "history" (
  "history_id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "user_id" uuid NOT NULL,
  "type" history_type NOT NULL,
  "query" varchar,
  "log_date" timestamptz NOT NULL DEFAULT (now()),
  "description" varchar
);

CREATE TABLE "kartu_garansi" (
  "noKartuGaransi" varchar PRIMARY KEY NOT NULL,
  "noInventaris" varchar NOT NULL,
  "jenisGaransi" varchar NOT NULL,
  "masaGaransi" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now())
);

CREATE TABLE "kartu_stok_aset" (
  "noInventaris" varchar PRIMARY KEY NOT NULL,
  "ruang" varchar NOT NULL,
  "hargaPerolehan" int4 NOT NULL,
  "masaManfaat" varchar NOT NULL,
  "supplier" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "pengguna" varchar,
  "isShow" bool,
  "noPo" varchar,
  "statusPerolehan" varchar,
  "lokasi" varchar,
  "kondisi" varchar,
  "isWaranty" bool,
  "productId" uuid
);

CREATE TABLE "kartu_stok_non_aset" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "lokasiGudang" varchar NOT NULL,
  "lokasiRak" varchar NOT NULL,
  "satuan" varchar NOT NULL,
  "jumlahStok" int4 NOT NULL,
  "hargaRerata" int4 NOT NULL,
  "saldoMin" int4 NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "productId" uuid
);

CREATE TABLE "ksa_kendaraan" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "namaStnk" varchar,
  "alamatStnk" varchar,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "ksa" varchar,
  "peruntukan" varchar
);

CREATE TABLE "ksa_nomor" (
  "kode" varchar PRIMARY KEY NOT NULL,
  "nama" varchar NOT NULL,
  "nomor" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "ksa" varchar
);

CREATE TABLE "golongan" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "namaGolongan" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now())
);

CREATE TABLE "kelompok" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "namaKelompok" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "kodeGol" uuid
);

CREATE TABLE "sub_kelompok" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "namaSub" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "kodeKelompok" uuid
);

CREATE TABLE "barang" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "namaBarang" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "kodeSub" uuid
);

CREATE TABLE "product" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "nama" varchar NOT NULL,
  "gambar" varchar NOT NULL,
  "merek" varchar NOT NULL,
  "satuan" varchar,
  "deskripsi" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "kodeBarang" uuid
);

CREATE TABLE "product_kendaraan" (
  "id" uuid PRIMARY KEY NOT NULL DEFAULT (uuid_generate_v4()),
  "tipe" varchar NOT NULL,
  "bahanBakar" varchar NOT NULL,
  "thPembuatan" varchar NOT NULL,
  "warna" varchar NOT NULL,
  "hp" varchar NOT NULL,
  "createdAt" timestamptz NOT NULL DEFAULT (now()),
  "updatedAt" timestamptz NOT NULL DEFAULT (now()),
  "productId" uuid
);

ALTER TABLE "history" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("user_id");

ALTER TABLE "ksa_kendaraan" ADD FOREIGN KEY ("ksa") REFERENCES "kartu_stok_aset" ("noInventaris");

ALTER TABLE "ksa_nomor" ADD FOREIGN KEY ("ksa") REFERENCES "kartu_stok_aset" ("noInventaris");

ALTER TABLE "kelompok" ADD FOREIGN KEY ("kodeGol") REFERENCES "golongan" ("id");

ALTER TABLE "sub_kelompok" ADD FOREIGN KEY ("kodeKelompok") REFERENCES "kelompok" ("id");

ALTER TABLE "barang" ADD FOREIGN KEY ("kodeSub") REFERENCES "sub_kelompok" ("id");

ALTER TABLE "product" ADD FOREIGN KEY ("kodeBarang") REFERENCES "barang" ("id");

ALTER TABLE "product_kendaraan" ADD FOREIGN KEY ("productId") REFERENCES "product" ("id");

ALTER TABLE "kartu_stok_non_aset" ADD FOREIGN KEY ("productId") REFERENCES "product" ("id");

ALTER TABLE "kartu_stok_aset" ADD FOREIGN KEY ("productId") REFERENCES "product" ("id");

ALTER TABLE "kartu_garansi" ADD FOREIGN KEY ("noInventaris") REFERENCES "kartu_stok_aset" ("noInventaris");
