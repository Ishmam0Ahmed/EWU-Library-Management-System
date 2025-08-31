
-- Create database and tables for EWU LMS
CREATE DATABASE IF NOT EXISTS ewu_lms CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ewu_lms;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','librarian','admin') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(160) NOT NULL,
  isbn VARCHAR(40),
  category VARCHAR(120),
  department VARCHAR(120),
  total_copies INT NOT NULL DEFAULT 1,
  available_copies INT NOT NULL DEFAULT 1,
  cover_url VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS loans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  checkout_date DATE NOT NULL,
  due_date DATE NOT NULL,
  return_date DATE NULL,
  fine_amount DECIMAL(10,2) NOT NULL DEFAULT 0,
  CONSTRAINT fk_loans_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_loans_book FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  status ENUM('pending','available','fulfilled','cancelled') NOT NULL DEFAULT 'pending',
  created_at DATETIME NOT NULL,
  notified_at DATETIME NULL,
  CONSTRAINT fk_res_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_res_book FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS fines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  loan_id INT NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  is_paid TINYINT(1) NOT NULL DEFAULT 0,
  paid_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_fine_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_fine_loan FOREIGN KEY (loan_id) REFERENCES loans(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS activity_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action VARCHAR(60) NOT NULL,
  details TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO users(name,email,password_hash,role) VALUES
('Admin','admin@ewu.edu', '$2y$10$7y2q3h9l6l8Yb0OaYf7/We2i3qj8W7h7oH2K5a1b5wqJ9k8pZJ4u', 'admin'); -- password: admin123

INSERT INTO books(title,author,isbn,category,department,total_copies,available_copies) VALUES
('Database System Concepts','Silberschatz','9780073523323','Databases','CSE',5,5),
('Introduction to Algorithms','Cormen','9780262033848','Algorithms','CSE',3,3),
('Artificial Intelligence: A Modern Approach','Russell','9780136042594','AI','CSE',4,4);
