rem pg_dump -U postgres -W -F p db1 > dump_db1.sql
rem psql -U postgres  db1 < notes_postgresql.sql

rem pg_restore -U postgres -d db1 ./dump_notes.sql
rem psql -U postgres  db1 < dump_notes.sql
psql -U postgres  db1 < dump_notes_all.sql

