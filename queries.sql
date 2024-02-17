--Creating tables 
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  email VARCHAR(50) NOT NULL,
  fullname VARCHAR(50) NOT NULL,
  passkey VARCHAR(100) NOT NULL
)

CREATE TABLE blogs (
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES  users(id),
  title VARCHAR(50) NOT NULL,
  content TEXT NOT NULL,
  image_link TEXT
)

CREATE TABLE likes(
  user_id INTEGER REFERENCES  users(id),
  blog_id INTEGER REFERENCES blogs(id),
  PRIMARY KEY(user_id, blog_id)
)

CREATE TABLE comments(
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES  users(id),
  blog_id INTEGER REFERENCES blogs(id),
  content TEXT NOT NULL
)

--Inserting data
INSERT INTO users (email, fullname, passkey)
VALUES ('damzymike@gmail.com', 'Michael Olofin', 'alright')

--Getting data
SELECT * FROM users

SELECT * FROM users
WHERE id = 1

--Deleting data
DELETE FROM users
WHERE id = 1

