CREATE DATABASE IF NOT EXISTS db_todo;

GRANT ALL PRIVILEGES ON db_todo.* TO 'todo_user'@'localhost' IDENTIFIED BY 'todo_password';

CREATE TABLE IF NOT EXISTS db_todo.todo  (
  id INT NOT NULL AUTO_INCREMENT, 
  name CHAR(80) NOT NULL, 
  detail VARCHAR(255), 
  created TIMESTAMP DEFAULT 0, 
  modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id));

TRUNCATE TABLE db_todo.todo;

INSERT IGNORE INTO db_todo.todo (name, detail, created) VALUES 
  ("Make Coffee", "\"Blacker than the blackest black...times infinity...\" -- Nathan Explosion, Metalocalypse", NULL),
  ("Drink Coffee", "\"If this is coffee, please bring me some tea; but if this is tea, please bring me some coffee.\" -- Abraham Lincoln ", NULL),
  ("Drink More Coffee", "\"Life is just one cup of coffee after another, and don't look for anything else.\" -- Bertrand Russel", NULL),
  ("Be Awesome", "It is by caffeine alone I set my mind in motion. It is by the beans of Java that thoughts acquire speed, the hands acquire shaking, the shaking is a warning. It is by caffeine alone I set my mind in motion.", NULL);
  
  