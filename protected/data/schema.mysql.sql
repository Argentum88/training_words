CREATE DATABASE training_words
  CHARACTER SET utf8
  COLLATE utf8_general_ci;

USE training_words;

/* Tables */
CREATE TABLE dictionary (
  id           int AUTO_INCREMENT NOT NULL,
  eng_word_id  int NOT NULL,
  rus_word_id  int NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE eng_word (
  id    int AUTO_INCREMENT NOT NULL,
  word  varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE my_dictionary (
  id             int AUTO_INCREMENT NOT NULL,
  id_user        int NOT NULL,
  id_dictionary  int NOT NULL,
  progress       int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE rus_word (
  id    int AUTO_INCREMENT NOT NULL,
  word  varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE `user` (
  id          int AUTO_INCREMENT NOT NULL,
  username    varchar(128) NOT NULL,
  `password`  varchar(128) NOT NULL,
  salt        varchar(128) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

/* Indexes */
CREATE UNIQUE INDEX dictionary
  ON dictionary
  (eng_word_id, rus_word_id);

CREATE INDEX rus_word
  ON dictionary
  (rus_word_id);

CREATE UNIQUE INDEX word
  ON eng_word
  (word);

CREATE INDEX dictionary
  ON my_dictionary
  (id_dictionary);

CREATE INDEX `user`
  ON my_dictionary
  (id_user);

CREATE UNIQUE INDEX word
  ON rus_word
  (word);

/* Foreign Keys */
ALTER TABLE dictionary
  ADD CONSTRAINT eng_word
  FOREIGN KEY (eng_word_id)
    REFERENCES eng_word(id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

ALTER TABLE dictionary
  ADD CONSTRAINT rus_word
  FOREIGN KEY (rus_word_id)
    REFERENCES rus_word(id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

ALTER TABLE my_dictionary
  ADD CONSTRAINT dictionary
  FOREIGN KEY (id_dictionary)
    REFERENCES dictionary(id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

ALTER TABLE my_dictionary
  ADD CONSTRAINT `user`
  FOREIGN KEY (id_user)
    REFERENCES `user`(id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

/* Data for table "dictionary" */
INSERT INTO dictionary (id, eng_word_id, rus_word_id) VALUES
  (1, 1, 1),
  (2, 2, 2),
  (3, 3, 3),
  (4, 4, 4),
  (5, 5, 5),
  (6, 6, 6),
  (7, 7, 7),
  (8, 8, 8),
  (9, 9, 9),
  (10, 10, 10),
  (11, 11, 11),
  (12, 12, 12),
  (13, 13, 13),
  (14, 14, 14),
  (15, 15, 15),
  (16, 16, 16),
  (17, 17, 17),
  (18, 18, 18),
  (19, 19, 19),
  (20, 20, 20),
  (21, 21, 21),
  (22, 22, 22),
  (23, 23, 23),
  (24, 24, 24),
  (25, 25, 25),
  (26, 26, 26),
  (27, 27, 27),
  (28, 28, 28),
  (29, 29, 29),
  (30, 30, 30);


/* Data for table "eng_word" */
INSERT INTO eng_word (id, word) VALUES
  (1, 'access'),
  (2, 'algorithm'),
  (3, 'board'),
  (4, 'byte'),
  (5, 'class'),
  (6, 'cluster'),
  (7, 'code'),
  (8, 'computer'),
  (9, 'computing'),
  (10, 'configuration'),
  (11, 'constructor'),
  (12, 'customization'),
  (13, 'database'),
  (14, 'debug'),
  (15, 'debugger'),
  (16, 'destructor'),
  (17, 'develop'),
  (18, 'developer'),
  (19, 'developing'),
  (20, 'diskette'),
  (21, 'distributed system'),
  (22, 'dummy'),
  (23, 'event'),
  (24, 'example'),
  (25, 'fault-tolerant'),
  (26, 'folder'),
  (27, 'function'),
  (28, 'hacker'),
  (29, 'hard disk'),
  (30, 'high availability');


/* Data for table "my_dictionary" */
INSERT INTO my_dictionary (id, id_user, id_dictionary, progress) VALUES
  (1, 1, 1, 0),
  (2, 1, 2, 0),
  (3, 1, 3, 0),
  (4, 1, 4, 0),
  (5, 1, 5, 0),
  (6, 1, 6, 0),
  (7, 1, 7, 0),
  (8, 1, 8, 0),
  (9, 1, 9, 0),
  (10, 1, 10, 0),
  (11, 1, 11, 0),
  (12, 1, 12, 0),
  (13, 1, 13, 0),
  (14, 1, 14, 0),
  (15, 1, 15, 0),
  (16, 1, 16, 0),
  (17, 1, 17, 0),
  (18, 1, 18, 0),
  (19, 1, 19, 0),
  (20, 1, 20, 0),
  (21, 1, 21, 0),
  (22, 1, 22, 0),
  (23, 1, 23, 0),
  (24, 1, 24, 0),
  (25, 1, 25, 0),
  (26, 1, 26, 0),
  (27, 1, 27, 0),
  (28, 1, 28, 0),
  (29, 1, 29, 0),
  (30, 1, 30, 0);


/* Data for table "rus_word" */
INSERT INTO rus_word (id, word) VALUES
  (2, 'алгоритм'),
  (13, 'база данных'),
  (4, 'байт'),
  (30, 'высокая доступность'),
  (9, 'вычисление'),
  (16, 'деструктор'),
  (20, 'дискета'),
  (1, 'доступ'),
  (29, 'жесткий диск'),
  (5, 'класс'),
  (6, 'кластер'),
  (7, 'код'),
  (8, 'компьютер'),
  (11, 'конструктор'),
  (10, 'конфигурация'),
  (22, 'ламер'),
  (12, 'настройка'),
  (25, 'отказоустойчивость'),
  (15, 'отладчик (программа для отладки кода)'),
  (14, 'отлаживать (программу)'),
  (26, 'папка (на компьютере)'),
  (3, 'плата'),
  (24, 'пример'),
  (17, 'разрабатывать'),
  (19, 'разработка'),
  (18, 'разработчик'),
  (21, 'распределенная система'),
  (23, 'событие (программное)'),
  (27, 'функция'),
  (28, 'хакер');


/* Data for table "user" */
INSERT INTO `user` (id, username, `password`, salt) VALUES
  (1, 'demo', '2e5c7db760a33498023813489cfadc0b', '28b206548469ce62182048fd9cf91760');