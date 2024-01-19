
CREATE TABLE Users(
  user_id int(11) AUTO_INCREMENT,
  user_name VARCHAR(255) NOT NULL,
  user_email VARCHAR(255) UNIQUE,
  user_password VARCHAR(255) NOT NULL,
  PRIMARY KEY(user_id)
);
