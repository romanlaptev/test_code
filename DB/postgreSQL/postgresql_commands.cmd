rem pg_dump -U postgres -W -F p db1 > dump_db1.sql
psql -U postgres  db1 < notes_postgresql.sql
pg_restore -d db1 ./notes_postgresql.sql -U postgres

