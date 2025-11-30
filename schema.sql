
CREATE DATABASE IF NOT EXISTS crud_buku;
USE crud_buku;

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  author VARCHAR(100) NOT NULL,
  year_published INT NOT NULL,
  category VARCHAR(50) NOT NULL,
  cover_path VARCHAR(255),
  status ENUM('available','unavailable') DEFAULT 'available'
);
