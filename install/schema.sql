DROP TABLE posts;
CREATE TABLE `posts`
(	
	`pid`		   	int(10) unsigned AUTO_INCREMENT,
	`title`			char(30),
	`body`			blob,
	`postdatetime`		datetime DEFAULT CURRENT_TIMESTAMP,
	`authorid`		int(10) unsigned NOT NULL
	PRIMARY KEY		(`id`),
	FOREIGN KEY 		(`authorid`)
		REFERENCES users(`id`),
);

DROP TABLE `users`;
CREATE TABLE `users`
(	`uid`			int(10) unsigned NOT NULL AUTO_INCREMENT,
	`username`		char(30) NOT NULL,
	`password`		char(30) NOT NULL,
	`displayname`		char(30) NOT NULL,
	`email`			char(30) NOT NULL,
	`isadmin`		boolean NOT NULL DEFAULT false,
	`lastlogin`		datetime,
	PRIMARY KEY		(`id`),
	UNIQUE KEY		(`username`),
	UNIQUE KEY		(`email`)
)

DROP TABLE `comments`;
CREATE TABLE `comments`
(	`cid`			int(10) unsigned NOT NULL AUTO_INCREMENT,
	`title`			char(30),
	`commentdatetime`	datetime,
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
	ALTER TABLE posts CHANGE COLUMN `post_date` `postdatetime` datetime;
	ALTER TABLE posts CHANGE COLUMN `postsid` `id` int(10) unsigned AUTO_INCREMENT;
	ALTER TABLE posts CHANGE COLUMN `author` `authorid` int(10) unsigned NOT NULL;
	ALTER TABLE posts DROP COLUMN `post_comment`;
	ALTER TABLE posts ADD FOREIGN KEY (`authorid`) REFERENCES users(`id`);
	DROP TABLE people;

Added comments and users tables.

/* changes to database on 11/15/2019 */
Ran this command:
	ALTER TABLE posts MODIFY postdatetime datetime DEFAULT CURRENT_TIMESTAMP;
	ALTER TABLE users ADD `displayname` char(30) NOT NULL AFTER id;

/* changes to database on 12/1/2019 */
Ran this command:
	ALTER TABLE posts CHANGE COLUMN `id` `pid` int(10) unsigned NOT NULL AUTO_INCREMENT;
	ALTER TABLE users CHANGE COLUMN `id` `uid` int(10) unsigned NOT NULL AUTO_INCREMENT;
	ALTER TABLE comments CHANGE COLUMN `id` `cid` int(10) unsigned NOT NULL AUTO_INCREMENT;

