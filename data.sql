CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    added_by INT,
    last_updated_by INT,
    last_updated_at DATETIME,
    FOREIGN KEY (added_by) REFERENCES users(id),
    FOREIGN KEY (last_updated_by) REFERENCES users(id)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    content TEXT NOT NULL,
    added_by INT,
    last_updated_by INT,
    last_updated_at DATETIME,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (added_by) REFERENCES users(id),
    FOREIGN KEY (last_updated_by) REFERENCES users(id)
);
