
CREATE TABLE Items(
  item_id int(11) AUTO_INCREMENT,
  userCategory_id int(11),
  item_title VARCHAR(255),
  item_detail VARCHAR(255),
  item_created_date DATE,
  item_start_date DATE,
  item_end_date DATE,
  PRIMARY KEY(item_id),
  FOREIGN KEY(userCategory_id) REFERENCES UserCategory(userCategory_id),
  FOREIGN KEY(item_start_date) REFERENCES Calendar(calendar_date),
  FOREIGN KEY(item_end_date) REFERENCES Calendar(calendar_date)
);
