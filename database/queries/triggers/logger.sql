CREATE TRIGGER log_books_insert
    AFTER INSERT ON books
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, book_id, old_value, new_value, created_at)
    VALUES ('books', 'INSERT', NEW.book_id, NULL, json_object('book_id', NEW.book_id, 'title', NEW.title, 'ISBN', NEW.ISBN, 'available', NEW.available), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_books_update
    AFTER UPDATE ON books
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, book_id, old_value, new_value, created_at)
    VALUES ('books', 'UPDATE', NEW.book_id, json_object('title', OLD.title, 'ISBN', OLD.ISBN, 'available', OLD.available), json_object('title', NEW.title, 'ISBN', NEW.ISBN, 'available', NEW.available), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_books_delete
    AFTER DELETE ON books
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, book_id, old_value, new_value, created_at)
    VALUES ('books', 'DELETE', OLD.book_id, json_object('title', OLD.title, 'ISBN', OLD.ISBN, 'available', OLD.available), NULL, CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_loans_insert
    AFTER INSERT ON loans
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, loan_id, old_value, new_value, created_at)
    VALUES ('loans', 'INSERT', NEW.loan_id, NULL, json_object('loan_id', NEW.loan_id, 'book_id', NEW.book_id, 'user_id', NEW.user_id), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_loans_update
    AFTER UPDATE ON loans
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, loan_id, old_value, new_value, created_at)
    VALUES ('loans', 'UPDATE', NEW.loan_id, json_object('returned_at', OLD.returned_at), json_object('returned_at', NEW.returned_at), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_loans_delete
    AFTER DELETE ON loans
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, loan_id, old_value, new_value, created_at)
    VALUES ('loans', 'DELETE', OLD.loan_id, json_object('loan_id', OLD.loan_id), NULL, CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_users_insert
    AFTER INSERT ON users
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, user_id, old_value, new_value, created_at)
    VALUES ('users', 'INSERT', NEW.user_id, NULL, json_object('user_id', NEW.user_id, 'name', NEW.name, 'email', NEW.email), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_users_update
    AFTER UPDATE ON users
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, user_id, old_value, new_value, created_at)
    VALUES ('users', 'UPDATE', NEW.user_id, json_object('name', OLD.name), json_object('name', NEW.name), CURRENT_TIMESTAMP);
END;

CREATE TRIGGER log_users_delete
    AFTER DELETE ON users
    FOR EACH ROW
BEGIN
    INSERT INTO logs (table_name, operation, user_id, old_value, new_value, created_at)
    VALUES ('users', 'DELETE', OLD.user_id, json_object('user_id', OLD.user_id), NULL, CURRENT_TIMESTAMP);
END;
