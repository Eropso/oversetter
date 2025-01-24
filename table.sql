CREATE TABLE `book` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `book` varchar(255) NOT NULL,
 `languages` text NOT NULL,
 `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `book_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) 



CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(254) NOT NULL,
 `username` varchar(50) NOT NULL,
 `password` char(255) NOT NULL,
 `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
 `role` enum('user','admin') NOT NULL DEFAULT 'user',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 UNIQUE KEY `username` (`username`)
) 