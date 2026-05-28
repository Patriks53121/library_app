CREATE VIEW view_expired_loans AS
SELECT
    b.book_id,
    b.title,
    b.ISBN,
    l.borrowed_at,
    l.borrowed_due,
    l.returned_at,
    CAST((julianday(datetime('now')) - julianday(l.borrowed_due)) AS INTEGER) as expired_days,
    u.user_id,
    u.name
FROM books as b
         JOIN loans as l ON b.book_id = l.book_id
         JOIN users as u ON l.user_id = u.user_id
WHERE l.returned_at IS NULL
  AND l.borrowed_due < datetime('now');