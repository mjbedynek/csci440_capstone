DROP TABLE posts;
CREATE TABLE `posts`
(	`postsid`   	INT PRIMARY KEY AUTO_INCREMENT,
	`Title`			CHAR(30),
	`Body`			BLOB,
	`post_date`		date,
	`post_comment`	char(30),
	`author`		char(30)
);

DROP TABLE people;
CREATE TABLE `people`
(	`authorid`		INT PRIMARY KEY AUTO_INCREMENT,
	`author`		char(30) NOT NULL,
	`position`		char(30) NOT NULL,
	`phone`			int NOT NULL
)
