CREATE DATABASE ads;

CREATE USER 'svads'@'%' IDENTIFIED BY 's3mple';
GRANT CREATE,SELECT,INSERT,UPDATE,DELETE ON ads.* TO 'svads'@'%';
FLUSH PRIVILEGES;

CREATE TABLE  `clicks` (
  `Account` varchar(50) NOT NULL default 'testing',
  `Counter` bigint(20) unsigned default '0',
  `LastMod` datetime default NULL,
  `LastIP` varchar(15) default NULL,
  `TinyURL` varchar(90) default NULL default '',
 PRIMARY KEY  USING BTREE (`Account`),
  KEY `Counter_Index` (`Counter`),
  KEY `LastIP_Index` (`LastIP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*** sample data ***/
INSERT INTO `clicks` (Account, Counter, LastMod, LastIP, TinyURL)
VALUES ('testing', 1, CURRENT_TIMESTAMP, '127.0.0.1', '')
ON DUPLICATE KEY UPDATE Counter = Counter + 1, LastMod = CURRENT_TIMESTAMP;
