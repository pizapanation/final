
CREATE TABLE Calendar(
  calendar_date DATE,
  PRIMARY KEY(calendar_date)
);

CREATE TABLE Users(
  user_id int(11) AUTO_INCREMENT,
  user_name VARCHAR(255),
  user_email VARCHAR(255),
  user_password VARCHAR(255),
  PRIMARY KEY(user_id)
);

CREATE TABLE Category(
  category_id int(11) AUTO_INCREMENT,
  category_name VARCHAR(255),
  PRIMARY KEY(category_id)
);
