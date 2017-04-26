
CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id`, `password`) VALUES
(1, '1234');


CREATE TABLE `card` (
  `card_number` int(10) NOT NULL,
  `account_number` int(10) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `card_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `account_number` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `card`
  ADD PRIMARY KEY (`card_number`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`account_number`);

ALTER TABLE card
    ADD CONSTRAINT fk_account_number
    FOREIGN KEY (account_number)
    REFERENCES user(account_number)
    ON UPDATE CASCADE
    ON DELETE CASCADE;