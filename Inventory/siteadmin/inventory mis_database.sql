

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_number` varchar(255) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO accounts VALUES("1","3","Mobile Money"," 07804943456                                                                                                                                ");
INSERT INTO accounts VALUES("2","3","Airtel Money"," 07399365265                                                                                                                     ");
INSERT INTO accounts VALUES("4","3","Bank of Kigali","2850848477431                                                                                                               ");
INSERT INTO accounts VALUES("5","3","BPR","00285084842111                                                                                                                             ");
INSERT INTO accounts VALUES("6","3","Equity Bank","066673322");
INSERT INTO accounts VALUES("7","2","Mobile Money","                                                                                0785734885                                                                            ");



CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `customer_id` (`customer_id`),
  KEY `pr_id` (`pr_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO cart VALUES("4","7","7","6","Cassava","100","300");
INSERT INTO cart VALUES("5","3","7","14","Vegetables","2000","180");



CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `telphone` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `joined_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO customers VALUES("1","Fidel","NDAYISHIMIYE","fullstackdeveloppers","e034fb6b66aacc1d48f445ddfb08da98","780494000","on","2022-02-16","Kigali","Kicukiro","Kagarama","Muyange","Mugeyo","0000-00-00","1");
INSERT INTO customers VALUES("2","kabarira","kampogo","test@gmail.com","6c14da109e294d1e8155be8aa4b1ce8e","2147483647","on","2022-02-18","North","Gakenke","Rushashi","Joma","Mataba","0000-00-00","1");
INSERT INTO customers VALUES("3","kalisa","MUGISHA","habineza1111@gmail.c","aa10d8881a7c0bafa1ae0be3b3a59a01","4322","on","2022-02-09","Kigali","Kicukiro","Kagarama","Muyange","Muyange","0000-00-00","1");
INSERT INTO customers VALUES("4","kalisa","MUGISHA","habineza1111@gmail.c","aa10d8881a7c0bafa1ae0be3b3a59a01","4322","on","2022-02-09","Kigali","Kicukiro","Kagarama","Muyange","Muyange","0000-00-00","1");
INSERT INTO customers VALUES("5","kamana","jbbd","habimana9999@gmail.c","6cd5f3e6d5f285f82ec3c351faa42294","65678","on","2022-02-02","Kigali","Kicukiro","Gikondo","Kanserege","Kanserege III","0000-00-00","1");
INSERT INTO customers VALUES("6","habarugira ","callixte","mutuyimana002@gmail.","827ccb0eea8a706c4c34a16891f84e7b","456789","on","2022-02-10","Kigali","Kicukiro","Kagarama","Muyange","Mugeyo","0000-00-00","1");
INSERT INTO customers VALUES("7","mugabo","stive","mugabo@gmail.com","81dc9bdb52d04dc20036dbd8313ed055","780484009","on","2022-02-16","East","Kayonza","Murundi","Karambi","Rwasama","0000-00-00","1");
INSERT INTO customers VALUES("8","kamanzi","eric","eric@gmail.com","202cb962ac59075b964b07152d234b70","554","on","2022-02-18","Kigali","Kicukiro","Kanombe","Karama","Cyurusagara","0000-00-00","1");
INSERT INTO customers VALUES("9","mugabe","kevin","mugabe@gmail.com","f899139df5e1059396431415e770c6dd","988844","on","2022-02-25","South","Nyanza","Kigoma","Butara","Kavumu","0000-00-00","1");
INSERT INTO customers VALUES("10","manzi","kevin","manzi@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","789813119","on","2022-02-16","South","Nyanza","Kibilizi","Rwotso","Rusagara","0000-00-00","1");
INSERT INTO customers VALUES("11","keza","kivin","keza@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","78932232","on","2022-02-03","Kigali","Kicukiro","Gatenga","Karambo","Jyambere","0000-00-00","1");



CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pr_id` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `cart_id` (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("1","2","7","2","Rice","528","400","2022-03-10","Received");
INSERT INTO orders VALUES("2","2","7","13","Vegetables","500","300","2022-03-14","Received");
INSERT INTO orders VALUES("3","2","7","23"," Rice","400","700","2022-03-15","Received");
INSERT INTO orders VALUES("4","2","7","22","Cassava","1000","300","2022-03-15","Received");



CREATE TABLE `products` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `season` varchar(255) NOT NULL,
  `unit_price` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `id` int(11) NOT NULL,
  `imag1` varchar(255) NOT NULL,
  `imag2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

INSERT INTO products VALUES("5","carrot","hghhfgfgdhdghf
scgfdfhsdsd
sdgvdsvd
dshdw","Vegetables","A","600","1002","0","2022-02-20","7","1645364304carrot1.jpg","");
INSERT INTO products VALUES("6","dryler","fxsdghdgfhkjyk
dgfhegjhrkl
scgdhfjgrlh","Cassava","A","300","900","0","2022-02-16","7","16453644181.jpg","");
INSERT INTO products VALUES("7","ibyumweru","ihfffjbf
fjbf
fjf
fjfbjb
FDAFKIF","Patotoes","C","1000","100","0","2022-02-20","2","1645368115IMG-20220209-WA0011.jpg","");
INSERT INTO products VALUES("13","imbwija","svcfxdtwytfujpdk
sdcgdgjwfj","Vegetables","","300","2000","0","2022-02-23","2","1645441816IMG-20220209-WA0011.jpg","");
INSERT INTO products VALUES("14"," orange","scgahdfrthlkyjlu hshdf
gsdhfjsthrjy
ssssdssdddsddddssddsdssddssdsddssddssdfassssddssaasasasassqwewwqweewrtyswdefrgtasdfghasdfghsdfrgthysdfghsdertytrewuytroiuytreoiuytreoiuytiuytrewhgfdwertyuuytrewertyuytre","Vegetables","","200","10000","180","2022-02-25","3","16457255543.jpg","");
INSERT INTO products VALUES("16"," cooperative","gswehgjrhtklyu
csgavhdjfgk","Beans","","200","1000","180","2022-02-24","3","1645809676IMG-20220209-WA0011.jpg","");
INSERT INTO products VALUES("17"," shyushya","cdnjs is a free and open-source software content delivery network hosted by Cloudflare. As of May 2021, it serves 4,013 JavaScript and CSS libraries, which are stored publicly on GitHub","Beans","","400","2000","350","2022-02-25","2","1646041247IMG-20220209-WA0014.jpg","");
INSERT INTO products VALUES("19","shyushya","In addition to the above code, the following JavaScript library files are loaded for use in this example:","Beans","","500","1550","0","2022-03-15","2","16473402282.jpg","");
INSERT INTO products VALUES("21","orange","gshdjfghl;
agshdfjgk","Vegetables","","800","140","0","2022-03-15","2","1647341797IMG-20220209-WA0011.jpg","");
INSERT INTO products VALUES("22","flesh","srdtfyhijo","Cassava","","300","6700","0","2022-03-15","2","16473421581.jpg","");
INSERT INTO products VALUES("24","buryohe","djbghvvxcbv
cxnbvc
cbvd
cxbv","Rice","","500","1500","0","2022-03-18","3","1647593051IMG-20220209-WA0015.jpg","");
INSERT INTO products VALUES("25"," kinigi","xscdvfghy"," Patotoes","","400","1700","0","2022-03-18","2","1647615037IMG-20220209-WA0009.jpg","");



CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sms` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`review_id`),
  KEY `pr_id` (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO reviews VALUES("1","2","fidel","fidel@gmail.com","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua product","4","2022-03-09 04:10:13");
INSERT INTO reviews VALUES("2","2","mugabo","mugabo@gmail.com","ashgdhjhkjsdfh
dvfjd
fdvbd
fdvbdf
","2","2022-03-09 21:12:40");
INSERT INTO reviews VALUES("3","2","kamana","test@gmail.com","good product","3","2022-03-09 08:59:03");
INSERT INTO reviews VALUES("4","2","Eugen Murera","fullstackdeveloppers@gmail.com","iyi product nisaw cyane","1","2022-03-09 09:00:32");
INSERT INTO reviews VALUES("5","2","churchil","test@gmail.com","you are good here","5","2022-03-09 10:16:41");
INSERT INTO reviews VALUES("6","2","emma","fullstackdeveloppers@gmail.com","lorem sdhjhd kcbjbjs","4","2022-03-09 10:32:59");
INSERT INTO reviews VALUES("7","18","kalisa","test@gmail.com","good product","5","2022-03-09 10:34:27");
INSERT INTO reviews VALUES("8","18","stiven","stiven@gmail.com","iyi product nisaw biringaniye","2","2022-03-10 01:13:40");
INSERT INTO reviews VALUES("9","2","claude","catr@gamil.com","hello , good product","4","2022-03-11 08:51:34");
INSERT INTO reviews VALUES("10","22","kamana","test@gmail.com","hello","4","2022-03-15 08:39:41");
INSERT INTO reviews VALUES("11","22","jbddg","demo@gmail.com","goood good","2","2022-03-16 05:59:36");
INSERT INTO reviews VALUES("12","22","claudine","catr@gamil.com","fhdhdg","4","2022-03-16 06:00:06");
INSERT INTO reviews VALUES("13","22","bvbcc","ccddsd@gmai.com","sddfgsaghdgd","5","2022-03-16 06:00:42");
INSERT INTO reviews VALUES("14","22","cbvb","station@gmail.com","dhggfjdm","5","2022-03-16 06:01:14");
INSERT INTO reviews VALUES("15","22","bssshhdgg","test11@gmail.com","gchvdjbfk","3","2022-03-16 06:16:45");
INSERT INTO reviews VALUES("16","22","kalisa","test@gmail.com","dstdyfuh","5","2022-03-16 06:30:36");



CREATE TABLE `tbl_history` (
  `hist_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `unit_price` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `action_date` date NOT NULL,
  `action_happened` varchar(255) NOT NULL,
  PRIMARY KEY (`hist_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_history VALUES("29","2","19","shyushya","Beans","","500","100","0","2022-03-15","Updated");
INSERT INTO tbl_history VALUES("30","2","23","buryohe","Rice","","700","758","0","2022-03-15","Added");
INSERT INTO tbl_history VALUES("31","2","23"," buryohe"," Rice","","700","200","0","2022-03-15","Updated");
INSERT INTO tbl_history VALUES("33","2","22","","Cassava","","300","1000","0","2022-03-15","Ordered");
INSERT INTO tbl_history VALUES("34","3","24","buryohe","Rice","","500","1500","0","2022-03-18","Added");
INSERT INTO tbl_history VALUES("35","2","25","kinigi","Patotoes","","400","1200","0","2022-03-18","Added");
INSERT INTO tbl_history VALUES("36","2","25"," kinigi"," Patotoes","","400","500","0","2022-03-18","Updated");



CREATE TABLE `tbl_shipping` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telphone` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `order_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`shipping_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `telphone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `tin_number` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `joined_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("2","Fidel","NDAYISHIMIYE","test@gmail.com","202cb962ac59075b964b07152d234b70","0780494005","male","111655378","East","Kayonza","Nyamirama","Musumba","Nyarunazi","depositer","2022-02-08","avatar5.png","1");
INSERT INTO users VALUES("3","Mugabo","Fabrice","mugabo@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","0780494003","male","1118678","Kigali","kicukiro","Kanombe","Ubumwe","Muhabura","depositer","2022-02-17","1645784006user8-128x128.jpg","1");
INSERT INTO users VALUES("5","kmanz","vicent","kma@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","98765","male","234567","Kigali","Kicukiro","Niboye","Niboye","Nyarubande","depositer","2022-02-16","avatar4.png","1");
INSERT INTO users VALUES("6","mukamana","deliphine","","827ccb0eea8a706c4c34a16891f84e7b","0780494000","male","11118976","East","Gatsibo","Nyagihanga","Murambi","Mubirembo","depositer","2022-02-01","avatar4.png","1");
INSERT INTO users VALUES("7","kalisa","emmy","emmy@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","0780494001","male","9888","South","Nyamagabe","Mugano","Yonde","Nyarusazi","depositer","2022-02-01","avatar4.png","1");
INSERT INTO users VALUES("9","habimana","kalisa","","827ccb0eea8a706c4c34a16891f84e7b","0780494678","Female","11144544","East","Gatsibo","Ngarama","Karambi","Kimbugu","depositer","2022-02-19","avatar4.png","1");
INSERT INTO users VALUES("10","John","Mbanda","","827ccb0eea8a706c4c34a16891f84e7b","0780494012","male","11999","East","Gatsibo","Rugarama","Gihuta","Ntende II","depositer","2022-02-25","avatar4.png","1");
INSERT INTO users VALUES("11","Admin User","Fidel","admin@gmail.com","e10adc3949ba59abbe56e057f20f883e","0780494006","male","1118743","Kigali","Kicukiro","Kigarama","Rwampara","Ubumwe","administrator","2022-03-11","1647280959user8-128x128.jpg","1");
INSERT INTO users VALUES("14","jolly","miss","missjolly@gmail.com","3db1c0d8b7d90ac9357baa1dd53d0844","0780494567","Female","1116534","Kigali","Kicukiro","Kanombe","Kabeza","Akagera","administrator","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("15","habumugisha","peter","test@gmail.com","c200e54be11110a9d809bd6d6b26fed2","0781223467","male","11122233","East","Gatsibo","Rwimbogo","Munini","Munini","depositer","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("16","mugemanyi","innocent","test@gmail.com","4e257cbe5b7f4220ebbb497841f3c0f6","0780494190","Female","11123456","East","Gatsibo","Rugarama","Gihuta","Ntende II","administrator","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("17","mutoni","clarisse","mutoni@gmail.com","69b1ac07a60eddcc6d867d5b15a73e5e","0780494913","Female","111153234","East","Ngoma","Rurenge","Musya","Kamugundu","administrator","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("18","murisa","theo","","25f9e794323b453885f5181f1b624d0b","0780494102","male","112123234","Kigali","Nyarugenge","Nyarugenge","Biryogo","Gabiro","depositer","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("19","stiven","jobs","admin001@gmail.com","07f80bc4ea6870d2b6c16309df8e4d2f","0780494167","male","1118999","East","Gatsibo","Rugarama","Kanyangese","Remera","administrator","2022-03-14","avatar4.png","1");
INSERT INTO users VALUES("20","kadafi","eugene","test001@gmail.com","827ccb0eea8a706c4c34a16891f84e7b","0780494876","male","11167232","North","Gakenke","Nemba","Gahinga","Bukurura","administrator","2022-03-16","avatar4.png","1");
INSERT INTO users VALUES("21","grace","nikuze","ndayishimiyefidel12@gmail.com","c20ad4d76fe97759aa27a0c99bff6710","0786012616","Female","11174746","North","Gakenke","Ruli","Gikingo","Gatwa","depositer","2022-03-18","avatar4.png","1");

