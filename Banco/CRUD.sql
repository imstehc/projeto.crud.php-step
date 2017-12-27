CREATE DATABASE CRUD DEFAULT CHARSET=utf8;


CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  
`descricao` varchar(50) DEFAULT NULL,
  `imagem` longblob NOT NULL,
 
 `data_cadastro` date DEFAULT NULL,
  `preco` decimal(18,6) DEFAULT NULL,
  
`categoria` varchar(50) DEFAULT NULL,
  `origem` varchar(45) DEFAULT NULL,
  
`tp_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
