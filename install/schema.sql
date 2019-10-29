DROP TABLE posts;
CREATE TABLE `posts`
(	
//	`postsid`	   	int(10) unsigned AUTO_INCREMENT,
	`id`		   	int(10) unsigned AUTO_INCREMENT,
	`title`			char(30),
	`body`			blob,
//	`post_date`		date,
	`date`			date,
//	`post_comment`		char(30),
//	`authorid`		char(30)
	`authorid`		int(10) unsigned NOT NULL
	PRIMARY KEY		(`id`),
	FOREIGN KEY 		(`userid`)
		REFERENCES users(`id`),
);

/* The people table will go away */
//DROP TABLE people;
//CREATE TABLE `people`
//(	`authorid`		INT PRIMARY KEY AUTO_INCREMENT,
//	`author`		char(30) NOT NULL,
//	`position`		char(30) NOT NULL,
//	`phone`			int NOT NULL
//)

DROP TABLE `users`;
CREATE TABLE `users`
(	`id`			int(10) unsigned NOT NULL AUTO_INCREMENT,
	`username`		char(30) NOT NULL,
	`password`		char(30) NOT NULL,
	`email`			char(30) NOT NULL,
	`isadmin`		boolean NOT NULL DEFAULT false,
	`lastlogin`		date,
	PRIMARY KEY		(`id`),
	UNIQUE KEY		(`email`)
)

DROP TABLE `comments`;
CREATE TABLE `comments`
(	`id`			int(10) unsigned NOT NULL AUTO_INCREMENT,
	`title`			char(30),
	`date`			date,
	`body`			blob NOT NULL,
	`approved`		boolean NOT NULL DEFAULT false,
	`hidden`		boolean NOT NULL DEFAULT false,
	`userid`		int(10) unsigned NOT NULL,
	`postid`		int(10) unsigned NOT NULL,
	PRIMARY KEY		(`id`),
	FOREIGN KEY 		(`userid`)
		REFERENCES users(`id`),
	FOREIGN KEY 		(`postid`)
      		REFERENCES posts(`id`)
)


/* changes to database on 10/28/2019 */
Ran this command:
	ALTER TABLE posts MODIFY COLUMN `postsid` int(10) unsigned AUTO_INCREMENT;
	ALTER TABLE posts RENAME COLUMN `post_date` TO `date`;
	ALTER TABLE posts RENAME COLUMN `postsid` TO `id`;
	ALTER TABLE posts DROP COLUMN `post_comment`;

Added comments and users tables.
