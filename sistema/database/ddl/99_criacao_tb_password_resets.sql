CREATE TABLE password_resets (
  email VARCHAR(250) NOT NULL,
  token VARCHAR(250) NOT NULL,
  created_at TIMESTAMP NULL,
  INDEX (email)
);
