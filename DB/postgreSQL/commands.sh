#!/bin/sh

psql -U root < create_db.sql
psql -U root -d db1 < dump_notes.sql
