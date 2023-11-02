
CREATE TABLE `price_master` (
  `id` int(11) NOT NULL,
  `price_range` varchar(200) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `price_from` varchar(50) NOT NULL,
  `price_to` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_master`
--

INSERT INTO `price_master` (`id`, `cat_id`,`price_range`, `price_from`, `price_to`) VALUES
(1,'','0 - 500', '0', '500'),
(2,'','501 - 2500', '501', '2500'),
(3,'','501 - 2500',  '501', '2500'),
(4,'','2501 - 5000', '2501', '5000'),
(5,'','5001 - 10000', '5001', '10000')

