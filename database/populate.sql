-- Populate USERS
INSERT INTO users (username, email, password, role_id) VALUES ('bernardo', '6ernardocampos@gmail.com', '$2a$12$DECNUSmm9C1QqwmHtGU.IOv4aFysjYiu/X24iGa8Yukayojf/ne3K', 3);

-- Populate DEPARTMENTS
INSERT INTO departments (name) VALUES ('dept1');

-- Populate STATUS
INSERT INTO status (name) VALUES ('Open');
INSERT INTO status (name) VALUES ('Assigned');
INSERT INTO status (name) VALUES ('Closed');