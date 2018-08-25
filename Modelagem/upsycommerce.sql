-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Ago-2018 às 07:00
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upsycommerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE `banner` (
  `COD_BANER` int(11) NOT NULL,
  `NOME_BANER` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO_BANER` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LINK_BANER` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `POSICAO_BANER` int(11) DEFAULT NULL,
  `TIP_ATIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`COD_BANER`, `NOME_BANER`, `FOTO_BANER`, `LINK_BANER`, `POSICAO_BANER`, `TIP_ATIVO`) VALUES
(1, 'ewdwdwed', 'uploads/media/Desert.jpg', 'ewdwedwed', 2, 1),
(2, 'wdefwefwf', 'uploads/media/Lighthouse.jpg', '2321214324', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `COD_CATEGORIA` int(10) UNSIGNED NOT NULL,
  `NOME_CATEGORIA` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `DES_CATEGORIA` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `URL_AMIGAVEL_CATEGORIA` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COD_PAI_CATEGORIA` int(11) DEFAULT NULL,
  `KEYWORD_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESCRIPTION_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TITLE_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIP_ATIVO` tinyint(1) DEFAULT NULL,
  `FOTO_CATEGORIA` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`COD_CATEGORIA`, `NOME_CATEGORIA`, `DES_CATEGORIA`, `URL_AMIGAVEL_CATEGORIA`, `COD_PAI_CATEGORIA`, `KEYWORD_SEO`, `DESCRIPTION_SEO`, `TITLE_SEO`, `TIP_ATIVO`, `FOTO_CATEGORIA`) VALUES
(19, 'teste', 'deded', 'eded', 20, 'ded', 'ed', 'ded', 1, ''),
(20, 'pedrin 22 2323', 'Olokooo meu ta ligado', 'apenas-de-teste', 19, 'teste; teste; teste;', '5645656456456 wrwewe', 'Apenas de Teste', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `COD_CLIENTE` int(10) UNSIGNED NOT NULL,
  `NOME_CLIENTE` varchar(280) COLLATE utf8_unicode_ci NOT NULL,
  `CPF_CLIENTE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CNPJ_CLIENTE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RAZAO_SOCIAL_CLIENTE` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `INSC_ESTADUAL_CLIENTE` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DTA_CADASTRO_CLIENTE` datetime NOT NULL,
  `DTA_NASCIMENTO` date DEFAULT NULL,
  `TELEFONE_CLIENTE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CELULAR_CLIENTE` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SEXO_CLIENTE` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_CLIENTE` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_CLIENTE` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupons`
--

CREATE TABLE `cupons` (
  `COD_CUPOM` int(10) UNSIGNED NOT NULL,
  `NOME_CUPOM` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PORCENT_DESCONTO` float NOT NULL,
  `DTA_INICIAL` datetime NOT NULL,
  `DTA_FINAL` datetime NOT NULL,
  `TIP_ATIVO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `COD_ENDERECO` int(11) NOT NULL,
  `CEP_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOGRADOURO_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NUMERO_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CIDADE_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ESTADO_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BAIRRO_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COMPLEMENTO_ENDERECO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIP_ENTREGA` tinyint(1) DEFAULT NULL,
  `COD_CLIENTE` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_produtos`
--

CREATE TABLE `fotos_produtos` (
  `COD_FOTO_PRODUTO` int(11) NOT NULL,
  `TITULO_FOTO_PRODUTO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO_PRODUTO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `COD_MARCA` int(10) UNSIGNED NOT NULL,
  `NOME_MARCA` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOTO_MARCA` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DES_MARCA` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `KEYWORD_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESCRIPTION_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TITLE_SEO` varchar(280) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIP_ATIVO` tinyint(1) DEFAULT NULL,
  `URL_AMIGAVEL` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`COD_MARCA`, `NOME_MARCA`, `FOTO_MARCA`, `DES_MARCA`, `KEYWORD_SEO`, `DESCRIPTION_SEO`, `TITLE_SEO`, `TIP_ATIVO`, `URL_AMIGAVEL`) VALUES
(1, 'wswsw1s', 'Desert.jpguploads/media/', 'wswsw1s', 'wswsw1s', 'wswsw1s', 'wswsw1s', 1, 'wswsw1s'),
(2, 'ewdwed', '', 'ewdwed', 'ewdwed', 'ewdwed', 'ewdwed', 1, 'ewdwed'),
(3, 'wedwedw', '', 'wedwedw', 'wedwedw', 'wedwedw', 'wedwedw', 0, 'wedwedw'),
(4, 'refef', '', 'refef', 'refef', 'refef', 'refef', 0, 'refef');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `COD_PAGAMENTO` int(11) NOT NULL,
  `DTA_CRIACAO` datetime NOT NULL,
  `DTA_MODIFICACAO` datetime DEFAULT NULL,
  `VLR_PAGTO` float NOT NULL,
  `CODE_TRANSACTION` varchar(480) COLLATE utf8_unicode_ci NOT NULL,
  `COD_TIPOPAGTO` int(11) NOT NULL,
  `COD_PEDIDO` int(11) NOT NULL,
  `NOME_PAGAMENTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE `paginas` (
  `COD_PAGINA` int(10) UNSIGNED NOT NULL,
  `TITULO_PAGINA` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DES_PAGINA` longtext COLLATE utf8_unicode_ci NOT NULL,
  `TIP_ATIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `paginas`
--

INSERT INTO `paginas` (`COD_PAGINA`, `TITULO_PAGINA`, `DES_PAGINA`, `TIP_ATIVO`) VALUES
(3, 'Termos e Condições 2', '<p>odipwejrmofwaofrmerfkrepofg</p><p>regerghlwrpl</p><p>trth</p><p>h</p><p>rt</p><p>whthrt</p>', 1),
(4, 'frf34f', '<p>334f</p>', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `COD_PEDIDO` int(11) NOT NULL,
  `DTA_CRIACAO_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIP_FRETE_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VLR_FRETE_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FORMA_PAGTO_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CLIENTE_COD_CLIENTE` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `COD_ITEM_PEDIDO` int(11) NOT NULL,
  `VLR_PRODUTO` float DEFAULT NULL,
  `QTD_PRODUTO` int(11) DEFAULT NULL,
  `COD_PRODUTO` int(11) DEFAULT NULL,
  `COD_PEDIDO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL,
  `EAN_PRODUTO` double DEFAULT NULL,
  `NOME_PRODUTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `NCM_PRODUTO` double DEFAULT NULL,
  `DES_PRODUTO` longtext COLLATE utf8_unicode_ci,
  `PRECO_PRODUTO` float DEFAULT NULL,
  `PRECO_PROMO_PRODUTO` float DEFAULT NULL,
  `DTA_INICIAL_PROMO` datetime DEFAULT NULL,
  `DTA_FINAL_PROMO` datetime DEFAULT NULL,
  `MODELO_PRODUTO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PESO_PRODUTO` float DEFAULT NULL,
  `COMPRIMENTO_PRODUTO` float DEFAULT NULL,
  `LARGURA_PRODUTO` float DEFAULT NULL,
  `ALTURA_PRODUTO` float DEFAULT NULL,
  `ESTOQUE_PRODUTO` int(11) DEFAULT NULL,
  `KEYWORD_SEO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESCRIPTION_SEO` longtext COLLATE utf8_unicode_ci,
  `TITLE_SEO` varchar(280) COLLATE utf8_unicode_ci DEFAULT NULL,
  `URL_AMIGAVEL_PRODUTO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIP_ATIVO` tinyint(1) DEFAULT NULL,
  `COD_MARCA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_categorias`
--

CREATE TABLE `produtos_categorias` (
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL,
  `COD_CATEGORIA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sw_status`
--

CREATE TABLE `sw_status` (
  `COD_STATUS` int(11) NOT NULL,
  `NOME_STATUS` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_atributo`
--

CREATE TABLE `tipo_atributo` (
  `COD_ATRIBUTO` int(10) UNSIGNED NOT NULL,
  `NOME_ATRIBUTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_atributo_valor`
--

CREATE TABLE `tipo_atributo_valor` (
  `COD_ATRIBUTO_VALOR` int(10) UNSIGNED NOT NULL,
  `COD_ATRIBUTO` int(11) NOT NULL,
  `NOME_VALOR` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `COD_TIPOPAGTO` int(11) NOT NULL,
  `NOME_TIPOPAGTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `COD_USUARIO` int(10) UNSIGNED NOT NULL,
  `NOME_USUARIO` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_USUARIO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_USUARIO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TIP_ATIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`COD_USUARIO`, `NOME_USUARIO`, `EMAIL_USUARIO`, `SENHA_USUARIO`, `TIP_ATIVO`) VALUES
(1, 'Administrador Upsy', 'admin@admin.com.br', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `variacao`
--

CREATE TABLE `variacao` (
  `COD_VARIACAO` int(10) UNSIGNED NOT NULL,
  `COD_PRODUTO` int(11) DEFAULT NULL,
  `TIPO_ATRIBUTO_1` int(11) NOT NULL,
  `VALOR_ATRIBUTO_1` int(11) NOT NULL,
  `TIPO_ATRIBUTO_2` int(11) NOT NULL,
  `VALOR_ATRIBUTO_2` int(11) NOT NULL,
  `PRECO_VARIACAO` decimal(10,0) DEFAULT NULL,
  `ESTOQUE_VARIACAO` int(11) DEFAULT NULL,
  `PESO_VARIACAO` decimal(10,0) DEFAULT NULL,
  `ALTURA_VARIACAO` int(11) DEFAULT NULL,
  `LARGURA_VARIACAO` int(11) DEFAULT NULL,
  `COMPRIMENTO_VARIACAO` int(11) DEFAULT NULL,
  `DTA_INI_VARIACAO_PROMO` date NOT NULL,
  `DTA_FIM_VARIACAO_PROMO` date NOT NULL,
  `PRECO_PROMO_VARIACAO` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`COD_BANER`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`COD_CATEGORIA`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`COD_CLIENTE`);

--
-- Indexes for table `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`COD_CUPOM`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`COD_ENDERECO`),
  ADD KEY `fk_ENDERECOS_CLIENTE1_idx` (`COD_CLIENTE`);

--
-- Indexes for table `fotos_produtos`
--
ALTER TABLE `fotos_produtos`
  ADD PRIMARY KEY (`COD_FOTO_PRODUTO`),
  ADD KEY `fk_FOTOS_PRODUTOS_PRODUTO1_idx` (`COD_PRODUTO`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`COD_MARCA`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`COD_PAGAMENTO`),
  ADD KEY `fk_PAGAMENTO_TIPO_PAGAMENTO1_idx` (`COD_TIPOPAGTO`),
  ADD KEY `fk_PAGAMENTO_PEDIDO1_idx` (`COD_PEDIDO`);

--
-- Indexes for table `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`COD_PAGINA`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`COD_PEDIDO`),
  ADD KEY `fk_PEDIDO_CLIENTE1_idx` (`CLIENTE_COD_CLIENTE`);

--
-- Indexes for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`COD_ITEM_PEDIDO`),
  ADD KEY `fk_PEDIDO_ITENS_PEDIDO_idx` (`COD_PEDIDO`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`COD_PRODUTO`,`COD_MARCA`),
  ADD KEY `fk_PRODUTO_MARCA1_idx` (`COD_MARCA`);

--
-- Indexes for table `produtos_categorias`
--
ALTER TABLE `produtos_categorias`
  ADD PRIMARY KEY (`COD_PRODUTO`,`COD_CATEGORIA`),
  ADD KEY `fk_PRODUTO_has_CATEGORIAS_CATEGORIAS1_idx` (`COD_CATEGORIA`),
  ADD KEY `fk_PRODUTO_has_CATEGORIAS_PRODUTO1_idx` (`COD_PRODUTO`);

--
-- Indexes for table `sw_status`
--
ALTER TABLE `sw_status`
  ADD PRIMARY KEY (`COD_STATUS`);

--
-- Indexes for table `tipo_atributo`
--
ALTER TABLE `tipo_atributo`
  ADD PRIMARY KEY (`COD_ATRIBUTO`);

--
-- Indexes for table `tipo_atributo_valor`
--
ALTER TABLE `tipo_atributo_valor`
  ADD PRIMARY KEY (`COD_ATRIBUTO_VALOR`);

--
-- Indexes for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`COD_TIPOPAGTO`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`COD_USUARIO`);

--
-- Indexes for table `variacao`
--
ALTER TABLE `variacao`
  ADD PRIMARY KEY (`COD_VARIACAO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `COD_BANER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `COD_CATEGORIA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `COD_CLIENTE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cupons`
--
ALTER TABLE `cupons`
  MODIFY `COD_CUPOM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `COD_MARCA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `COD_PAGINA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `COD_PRODUTO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sw_status`
--
ALTER TABLE `sw_status`
  MODIFY `COD_STATUS` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_atributo`
--
ALTER TABLE `tipo_atributo`
  MODIFY `COD_ATRIBUTO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_atributo_valor`
--
ALTER TABLE `tipo_atributo_valor`
  MODIFY `COD_ATRIBUTO_VALOR` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `COD_TIPOPAGTO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `COD_USUARIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `variacao`
--
ALTER TABLE `variacao`
  MODIFY `COD_VARIACAO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_ENDERECOS_CLIENTE1` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `mydb`.`cliente` (`COD_CLIENTE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fotos_produtos`
--
ALTER TABLE `fotos_produtos`
  ADD CONSTRAINT `fk_FOTOS_PRODUTOS_PRODUTO1` FOREIGN KEY (`COD_PRODUTO`) REFERENCES `mydb`.`produto` (`COD_PRODUTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `fk_PAGAMENTO_PEDIDO1` FOREIGN KEY (`COD_PEDIDO`) REFERENCES `mydb`.`pedido` (`COD_PEDIDO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PAGAMENTO_TIPO_PAGAMENTO1` FOREIGN KEY (`COD_TIPOPAGTO`) REFERENCES `mydb`.`tipo_pagamento` (`COD_TIPOPAGTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_PEDIDO_CLIENTE1` FOREIGN KEY (`CLIENTE_COD_CLIENTE`) REFERENCES `mydb`.`cliente` (`COD_CLIENTE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `fk_PEDIDO_ITENS_PEDIDO` FOREIGN KEY (`COD_PEDIDO`) REFERENCES `mydb`.`pedido` (`COD_PEDIDO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_PRODUTO_MARCA1` FOREIGN KEY (`COD_MARCA`) REFERENCES `mydb`.`marca` (`COD_MARCA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos_categorias`
--
ALTER TABLE `produtos_categorias`
  ADD CONSTRAINT `fk_PRODUTO_has_CATEGORIAS_CATEGORIAS1` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `mydb`.`categorias` (`COD_CATEGORIA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRODUTO_has_CATEGORIAS_PRODUTO1` FOREIGN KEY (`COD_PRODUTO`) REFERENCES `mydb`.`produto` (`COD_PRODUTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tipo_atributo_valor`
--
ALTER TABLE `tipo_atributo_valor`
  ADD CONSTRAINT `tipo_atributo_valor_ibfk_1` FOREIGN KEY (`COD_ATRIBUTO_VALOR`) REFERENCES `tipo_atributo` (`COD_ATRIBUTO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
