
CREATE TABLE UserCategory(
  userCategory_id int(11) AUTO_INCREMENT,
  user_id int(11),
  category_id int(11),
  PRIMARY KEY(userCategory_id),
  FOREIGN KEY(user_id) REFERENCES Users(user_id),
  FOREIGN key(category_id) REFERENCES Category(category_id)
);
