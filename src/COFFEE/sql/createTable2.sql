
CREATE TABLE Items(
  item_id int(11) AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  item_title VARCHAR(255) NOT NULL,
  item_detail VARCHAR(255) NOT NULL,
  item_created_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  item_start_date DATE NOT NULL,
  item_end_date DATE NOT NULL,
  completed_task BOOLEAN DEFAULT FALSE,
  PRIMARY KEY(item_id),
  FOREIGN KEY(user_id) REFERENCES Users(user_id)
);
