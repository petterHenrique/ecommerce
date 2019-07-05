-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Mar-2019 às 12:24
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
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `COD_AVALIACAO` int(10) UNSIGNED NOT NULL,
  `NUM_AVALIACAO` int(10) UNSIGNED NOT NULL,
  `COD_CLIENTE` int(10) UNSIGNED NOT NULL,
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL,
  `DES_AVALIACAO` varchar(8000) NOT NULL,
  `TIP_ATIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'wdefwefwf', 'uploads/media/Lighthouse.jpg', '2321214324', 2, 1),
(3, 'Foto ', 'uploads/media/cacserra-espingarda.JPG', 'https://www.falconarmas.com.br/punhal-e-adagas-s130/', 3, 1);

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
(28, 'Armas de Fogo', 'Confira alguns modelos de armas longas e curtas, com grandes variedades com o foco para a caça, tiro esportivo e defesa pessoal.', 'armas-de-fogo', 0, 'armas de fogo, espingardas, pistolas, revólveres', 'Confira alguns modelos de armas longas e curtas, com grandes variedades com o foco para a caça, tiro esportivo e defesa pessoal.', 'Armas de Fogo', 1, ''),
(29, 'Pistolas', 'Veja os diversos modelos de pistolas, das diferentes marcas como Taurus, Cbc, etc.', 'pistolas', 28, 'pistolas, armas curtas', 'Veja os diversos modelos de pistolas, das diferentes marcas como Taurus, Cbc, etc.', 'Pistolas', 1, ''),
(30, 'Revolver', 'Revolver', 'Revolver', 28, 'Revolver', 'Revolver', 'Revolver', 1, ''),
(31, 'Airsoft', 'Airsoft', 'Airsoft', 0, 'Airsoft', 'Airsoft', 'Airsoft', 1, ''),
(32, 'Carabina de Pressão', 'Carabina de Pressão', 'carabina-de-pressao', 0, 'Carabina de Pressão', 'Carabina de Pressão', 'Carabina de Pressão', 1, ''),
(33, 'teste', 'teste', 'teste', 28, 'teste', 'teste', 'teste', 1, NULL);

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

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`COD_CLIENTE`, `NOME_CLIENTE`, `CPF_CLIENTE`, `CNPJ_CLIENTE`, `RAZAO_SOCIAL_CLIENTE`, `INSC_ESTADUAL_CLIENTE`, `DTA_CADASTRO_CLIENTE`, `DTA_NASCIMENTO`, `TELEFONE_CLIENTE`, `CELULAR_CLIENTE`, `SEXO_CLIENTE`, `EMAIL_CLIENTE`, `SENHA_CLIENTE`) VALUES
(1, 'Pedro Henrique', '035.212.250-11', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '(54) 99186-7667', NULL, '', 'pedro@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Pedro H', '035.212.250-11', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '(54) 99186-7667', NULL, '', 'pedroteste@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes_correios`
--

CREATE TABLE `configuracoes_correios` (
  `COD_CONFIG` int(10) UNSIGNED NOT NULL,
  `CEP_ORIGEM` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `COD_CONTRATO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_CONTRATO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ATIVO` tinyint(1) NOT NULL,
  `MAO_PROPRIA` tinyint(1) NOT NULL,
  `VALOR_DECLARADO` decimal(10,0) NOT NULL,
  `VALOR_ADICIONAL` decimal(10,0) NOT NULL,
  `PRAZO_ENTREGA_DIAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `configuracoes_correios`
--

INSERT INTO `configuracoes_correios` (`COD_CONFIG`, `CEP_ORIGEM`, `COD_CONTRATO`, `SENHA_CONTRATO`, `ATIVO`, `MAO_PROPRIA`, `VALOR_DECLARADO`, `VALOR_ADICIONAL`, `PRAZO_ENTREGA_DIAS`) VALUES
(1, '95040410', '', '', 1, 0, '0', '0', 0);

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
-- Estrutura da tabela `dados_empresa`
--

CREATE TABLE `dados_empresa` (
  `COD_DADO` int(11) NOT NULL,
  `DES_TELEFONE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DES_WHATSAPP` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DES_HORARIO` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `DES_FACEBOOK` varchar(280) COLLATE utf8_unicode_ci NOT NULL,
  `DES_INSTAGRAM` varchar(280) COLLATE utf8_unicode_ci NOT NULL,
  `DES_RODAPE` longtext COLLATE utf8_unicode_ci NOT NULL,
  `DES_TITLE` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `DES_KEYWORDS` longtext COLLATE utf8_unicode_ci NOT NULL,
  `DES_DESCRIPTION` longtext COLLATE utf8_unicode_ci NOT NULL,
  `DES_EMAIL` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dados_empresa`
--

INSERT INTO `dados_empresa` (`COD_DADO`, `DES_TELEFONE`, `DES_WHATSAPP`, `DES_HORARIO`, `DES_FACEBOOK`, `DES_INSTAGRAM`, `DES_RODAPE`, `DES_TITLE`, `DES_KEYWORDS`, `DES_DESCRIPTION`, `DES_EMAIL`) VALUES
(1, '(54) 99186-7667', 'ewdwe', 'wedwe', 'wed', 'wedwed', 'wedwedwed', 'wedwed', 'wedwed', 'wedwed', 'contato@cacserra.com.br'),
(2, 'wedewdw', 'ewdwe', 'wedwe', 'wed', 'wedwed', 'wedwedwed', 'wedwed', 'wedwed', 'wedwed', ''),
(3, 'wedewdw', 'ewdwe', 'wedwe', 'wed', 'wedwed', 'wedwedwed', 'wedwed', 'wedwed', 'wedwed', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `COD_ENDERECO` int(11) UNSIGNED NOT NULL,
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

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`COD_ENDERECO`, `CEP_ENDERECO`, `LOGRADOURO_ENDERECO`, `NUMERO_ENDERECO`, `CIDADE_ENDERECO`, `ESTADO_ENDERECO`, `BAIRRO_ENDERECO`, `COMPLEMENTO_ENDERECO`, `TIP_ENTREGA`, `COD_CLIENTE`) VALUES
(1, '95040-410', 'Rua João Zandomeneghi', '1828', 'Caxias do Sul', 'RS', 'Universitário', 'Casa', 1, 1),
(2, '95010-060', 'Avenida Rio Branco', '1828', 'Caxias do Sul', 'RS', 'São Pelegrino', 'Casa', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_produtos`
--

CREATE TABLE `fotos_produtos` (
  `COD_FOTO_PRODUTO` int(11) NOT NULL,
  `TITULO_FOTO_PRODUTO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO_PRODUTO` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fotos_produtos`
--

INSERT INTO `fotos_produtos` (`COD_FOTO_PRODUTO`, `TITULO_FOTO_PRODUTO`, `FOTO_PRODUTO`, `COD_PRODUTO`) VALUES
(24, '1.jpg', '/uploads/catalogo/1.jpg', 56),
(25, '2.jpg', '/uploads/catalogo/2.jpg', 56),
(26, 'miura2.png', '/uploads/catalogo/miura2.png', 57),
(28, 'miura2-2.png', '/uploads/catalogo/miura2-2.png', 57),
(29, 'product-134-photo-3_690x460.jpg', '/uploads/catalogo/product-134-photo-3_690x460.jpg', 57),
(30, '2.jpg', '/uploads/catalogo/2.jpg', 58),
(31, '5.jpg', '/uploads/catalogo/5.jpg', 58),
(32, '1.png', '/uploads/catalogo/1.png', 59),
(33, '1.png', '/uploads/catalogo/1.png', 60),
(34, '2.png', '/uploads/catalogo/2.png', 60),
(35, '3.png', '/uploads/catalogo/3.png', 60),
(36, '4.png', '/uploads/catalogo/4.png', 60),
(37, 'alimentacao-plano.jpg', '/uploads/catalogo/alimentacao-plano.jpg', 60),
(38, 'background.jpg', '/uploads/catalogo/background.jpg', 60),
(39, 'background-emagrecimento.jpg', '/uploads/catalogo/background-emagrecimento.jpg', 60),
(40, 'bg-emagrecimento.jpg', '/uploads/catalogo/bg-emagrecimento.jpg', 60);

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
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `COD_ORCAMENTO` int(11) NOT NULL,
  `COD_PRODUTO` int(11) NOT NULL,
  `DES_CLIENTE` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DES_TELEFONE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DES_EMAIL` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DES_UF` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `COD_STATUS` int(11) NOT NULL,
  `DTA_SOLICITACAO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`COD_ORCAMENTO`, `COD_PRODUTO`, `DES_CLIENTE`, `DES_TELEFONE`, `DES_EMAIL`, `DES_UF`, `COD_STATUS`, `DTA_SOLICITACAO`) VALUES
(22, 43, 'Pedro Henrique', '(54) 99186-7667', 'pedro@gmail.com', 'rs', 1, '2019-01-30 00:48:48'),
(23, 43, 'Matheus', '(54) 98989-8989', 'mathes@gmail.com', 'rj', 1, '2019-01-30 02:23:16'),
(24, 43, 'Pedro Henrique', '(54) 99186-7667', 'p_h_campos@hotmail.com', 'pr', 2, '2019-01-31 01:15:59'),
(25, 57, 'Pedro Henrique', '(54) 99186-7667', 'p_h_campos@hotmail.com', 'rs', 1, '2019-02-03 22:35:19'),
(26, 57, 'Pedro Cesar', '(54) 98989-8988', 'pedrocesar@cacserra.com.br', 'rs', 2, '2019-02-03 22:45:17'),
(27, 57, '4r3r34r', '(54) 54545-4544', '4r34r4r43r', 'rn', 1, '2019-02-06 02:57:45');

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
  `NOME_PAGAMENTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `URL_BOLETO` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`COD_PAGAMENTO`, `DTA_CRIACAO`, `DTA_MODIFICACAO`, `VLR_PAGTO`, `CODE_TRANSACTION`, `COD_TIPOPAGTO`, `COD_PEDIDO`, `NOME_PAGAMENTO`, `URL_BOLETO`) VALUES
(5, '2019-03-12 02:32:15', '2019-03-12 02:32:15', 8, '80B030C1-E40E-4389-AFD2-B64C14F7EB8D', 1, 79, 'PAGSEGURO', ''),
(6, '2019-03-12 02:33:58', '2019-03-12 02:33:58', 8, '4F1A98F0-91DA-4105-8536-873C63F9F340', 1, 81, 'PAGSEGURO', ''),
(7, '2019-03-13 01:12:05', '2019-03-13 01:12:05', 2, '5743F88A-10D1-48E8-8A6E-24C0F9E2AD27', 1, 83, 'PAGSEGURO', ''),
(8, '2019-03-15 05:12:10', '2019-03-15 05:12:10', 2, 'D2D3648F-5C82-4B93-8035-2DC9BF559B43', 1, 102, 'PAGSEGUROBOLETO', ''),
(9, '2019-03-15 05:17:55', '2019-03-15 05:17:55', 2, '501A0A5D-B263-41F9-9EF4-B8C9BB670C66', 1, 103, 'PAGSEGUROBOLETO', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=408d6a7b6ca86e14cd884c2dd9d3590ac27ef466d31bf9d23c8849ef6726a8ece718f241051ca5d5'),
(10, '2019-03-15 05:18:52', '2019-03-15 05:18:52', 2, 'E4206A3D-513E-40BD-A659-7DBC300FDF50', 1, 104, 'PAGSEGUROBOLETO', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=9786f2c1afacd85c817e278400b89ff30aee02bbe3cb65bb6544367eb6cda8b2db6c692211fae235'),
(11, '2019-03-15 05:20:39', '2019-03-15 05:20:39', 2, 'F7D495A8-3E9C-48BE-BF4D-55B2F3E43B18', 1, 105, 'PAGSEGUROBOLETO', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=0eddc3a2c3900e26a14a165080a189d10b4dcd7de5dabea1b743a23681e4fc5937897f89265de2c4'),
(12, '2019-03-15 05:21:30', '2019-03-15 05:21:30', 2, '016490A5-A81B-4810-B50B-F60A4FFE148E', 1, 106, 'PAGSEGUROBOLETO', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=c7a00115a3c55717488cd3d06200b72d91a1c413108798adf63154ccc9d0d26b0c69e5a9f190a098'),
(13, '2019-03-15 05:21:40', '2019-03-15 05:21:40', 2, 'F6AE726B-5B55-4F87-875D-0F6978968F74', 1, 107, 'PAGSEGUROBOLETO', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=4c097975ab1c30882e770a7af5cdab0f05d48b01201cb682f8347e78bd3fc65d1297ed6bea34b696');

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
(5, 'Termos e Condições', ' erfege', 1),
(6, 'Sobre Empresa', 'teste', 1),
(7, 'Políticas de Entrega', 'teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `COD_PEDIDO` int(11) NOT NULL,
  `DTA_CRIACAO_PEDIDO` datetime DEFAULT NULL,
  `TIP_FRETE_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VLR_FRETE_PEDIDO` double DEFAULT NULL,
  `FORMA_PAGTO_PEDIDO` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS_PEDIDO` int(11) DEFAULT NULL,
  `CLIENTE_COD_CLIENTE` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`COD_PEDIDO`, `DTA_CRIACAO_PEDIDO`, `TIP_FRETE_PEDIDO`, `VLR_FRETE_PEDIDO`, `FORMA_PAGTO_PEDIDO`, `STATUS_PEDIDO`, `CLIENTE_COD_CLIENTE`) VALUES
(77, '2019-03-12 02:32:09', 'PAC', 0, 'cartaocredito', 1, 1),
(78, '2019-03-12 02:32:11', 'PAC', 0, 'cartaocredito', 1, 1),
(79, '2019-03-12 02:32:13', 'PAC', 0, 'cartaocredito', 1, 1),
(80, '2019-03-12 02:33:38', 'PAC', 0, 'cartaocredito', 1, 1),
(81, '2019-03-12 02:33:56', 'PAC', 0, 'cartaocredito', 1, 1),
(82, '2019-03-13 01:11:59', 'PAC', 0, 'cartaocredito', 1, 1),
(83, '2019-03-13 01:12:03', 'PAC', 0, 'cartaocredito', 1, 1),
(84, '2019-03-13 04:09:23', 'PAC', 0, NULL, 1, 1),
(85, '2019-03-13 04:15:56', 'PAC', 0, NULL, 1, 1),
(86, '2019-03-13 04:32:04', NULL, 0, NULL, 1, 1),
(87, '2019-03-13 04:32:46', NULL, 0, NULL, 1, 1),
(88, '2019-03-13 04:33:26', NULL, 0, NULL, 1, 1),
(89, '2019-03-13 04:36:36', NULL, 0, NULL, 1, 1),
(90, '2019-03-13 04:37:23', NULL, 0, NULL, 1, 1),
(91, '2019-03-13 04:37:46', NULL, 0, NULL, 1, 1),
(92, '2019-03-13 04:38:30', NULL, 0, NULL, 1, 1),
(93, '2019-03-13 04:39:02', NULL, 0, NULL, 1, 1),
(94, '2019-03-13 04:39:29', NULL, 0, NULL, 1, 1),
(95, '2019-03-13 04:40:03', NULL, 0, NULL, 1, 1),
(96, '2019-03-13 04:42:29', NULL, 0, NULL, 1, 1),
(97, '2019-03-13 04:44:03', NULL, 0, NULL, 1, 1),
(98, '2019-03-15 04:58:12', NULL, 0, NULL, 1, 1),
(99, '2019-03-15 04:59:10', NULL, 0, NULL, 1, 1),
(100, '2019-03-15 04:59:53', NULL, 0, NULL, 1, 1),
(101, '2019-03-15 05:00:22', NULL, 0, NULL, 1, 1),
(102, '2019-03-15 05:12:07', NULL, 0, NULL, 1, 1),
(103, '2019-03-15 05:17:53', NULL, 0, NULL, 1, 1),
(104, '2019-03-15 05:18:50', NULL, 0, NULL, 1, 1),
(105, '2019-03-15 05:20:36', NULL, 0, NULL, 1, 1),
(106, '2019-03-15 05:21:27', NULL, 0, NULL, 1, 1),
(107, '2019-03-15 05:21:38', NULL, 0, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pedido_detalhado`
-- (See below for the actual view)
--
CREATE TABLE `pedido_detalhado` (
`CODIGO_PEDIDO` int(11)
,`DTA_CRIACAO_PEDIDO` datetime
,`VLR_FRETE_PEDIDO` double
,`FORMA_PAGTO_PEDIDO` varchar(45)
,`STATUS_PEDIDO` int(11)
,`DES_STATUS` varchar(200)
,`CLIENTE_COD_CLIENTE` int(10) unsigned
,`CODIGO_CLIENTE` int(10) unsigned
,`NOME_CLIENTE` varchar(280)
,`CPF_CLIENTE` varchar(45)
,`DTA_CADASTRO_CLIENTE` datetime
,`DTA_NASCIMENTO` date
,`TELEFONE_CLIENTE` varchar(45)
,`CELULAR_CLIENTE` varchar(45)
,`EMAIL_CLIENTE` varchar(200)
,`COD_ITEM_PEDIDO` int(11)
,`VLR_PRODUTO` float
,`QTD_PRODUTO` int(11)
,`COD_PRODUTO` int(11)
,`COD_PEDIDO` int(11)
,`EAN_PRODUTO` varchar(400)
,`NOME_PRODUTO` varchar(200)
,`PRECO_PROMO_PRODUTO` float
,`COD_ENDERECO` int(11) unsigned
,`CEP_ENDERECO` varchar(45)
,`LOGRADOURO_ENDERECO` varchar(45)
,`NUMERO_ENDERECO` varchar(45)
,`CIDADE_ENDERECO` varchar(45)
,`ESTADO_ENDERECO` varchar(45)
,`BAIRRO_ENDERECO` varchar(45)
,`COMPLEMENTO_ENDERECO` varchar(45)
,`TIP_ENTREGA` tinyint(1)
,`COD_CLIENTE` int(10) unsigned
);

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

--
-- Extraindo dados da tabela `pedido_itens`
--

INSERT INTO `pedido_itens` (`COD_ITEM_PEDIDO`, `VLR_PRODUTO`, `QTD_PRODUTO`, `COD_PRODUTO`, `COD_PEDIDO`) VALUES
(155, 2, 4, 20, 77),
(156, 2, 4, 20, 78),
(157, 2, 4, 20, 79),
(158, 2, 4, 20, 80),
(159, 2, 4, 20, 81),
(160, 2, 1, 20, 82),
(161, 2, 1, 20, 83),
(162, 2, 1, 20, 84),
(163, 2, 1, 20, 85),
(164, 2, 1, 20, 86),
(165, 2, 1, 20, 87),
(166, 2, 1, 20, 88),
(167, 2, 1, 20, 89),
(168, 2, 1, 20, 90),
(169, 2, 1, 20, 91),
(170, 2, 1, 20, 92),
(171, 2, 1, 20, 93),
(172, 2, 1, 20, 94),
(173, 2, 1, 20, 95),
(174, 2, 1, 20, 96),
(175, 2, 1, 20, 97),
(176, 2, 1, 20, 98),
(177, 2, 1, 20, 99),
(178, 2, 1, 20, 100),
(179, 2, 1, 20, 101),
(180, 2, 1, 20, 102),
(181, 2, 1, 20, 103),
(182, 2, 1, 20, 104),
(183, 2, 1, 20, 105),
(184, 2, 1, 20, 106),
(185, 2, 1, 20, 107);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL,
  `EAN_PRODUTO` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOME_PRODUTO` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `NCM_PRODUTO` double DEFAULT NULL,
  `DES_PRODUTO` text COLLATE utf8_unicode_ci,
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
  `TIP_ARMA` tinyint(1) NOT NULL,
  `TIP_DESTAQUE` tinyint(1) NOT NULL,
  `COD_MARCA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`COD_PRODUTO`, `EAN_PRODUTO`, `NOME_PRODUTO`, `NCM_PRODUTO`, `DES_PRODUTO`, `PRECO_PRODUTO`, `PRECO_PROMO_PRODUTO`, `DTA_INICIAL_PROMO`, `DTA_FINAL_PROMO`, `MODELO_PRODUTO`, `PESO_PRODUTO`, `COMPRIMENTO_PRODUTO`, `LARGURA_PRODUTO`, `ALTURA_PRODUTO`, `ESTOQUE_PRODUTO`, `KEYWORD_SEO`, `DESCRIPTION_SEO`, `TITLE_SEO`, `URL_AMIGAVEL_PRODUTO`, `TIP_ATIVO`, `TIP_ARMA`, `TIP_DESTAQUE`, `COD_MARCA`) VALUES
(56, '6', '6', 6, '6 rtyrtyrtyrtty\n\n', 6, 6, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '', 8, 6, 6, 6, 6, '6', '62', '6', '6', 1, 0, 0, 0),
(57, '20', 'Espingar Boito Miura II Lavrada- Calibre .20', 20, 'Espingarda Boito Miura II Lavrada Bloco Inox - Calibre 20 A espingarda de canos sobrepostos com dois gatilhos, MIURA II, é a primeira espingarda de canos sobrepostos fabricada no Brasil. É usada intensamente por aqueles caçadores e atiradores que preferem, por hábito, usar dois gatilhos. As tradicionais características de desempenho e qualidade que deram fama aos produtos BOITO são encontradas nesta excelente espingarda: Extrator de dupla ação; Agulhas retráteis; Choque cambiável para cal. 12, 20 e 28. CARACTERÍSTICAS: - Fabricante: Boito - Modelo: Miura II Lavrada - Calibre: .20GA - Capacidade: 2 cartuchos (1 em cada cano) - Ação: Simples - Material: Aço e Madeira - Acabamento: Oxidado com Bloco de Inox - Coronha: Em nogueira com soleira macia - Peso: 3,4kg - Comprimento Total: 1140mm - Comprimento do cano: 760mm - Comprimento da câmara: 76mm - Miras: Fixas - Choque: Cambiável - Zarelhos: Possui\n\n', 28, 28, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Miura II', 8, 10, 4, 4, 2, 'epingarda, miaura II, boito, cal .20, boito', 'Espingarda de ótima qualidade.', 'Espingar Boito Miura II Lavrada- Calibre .20', 'espingarda-boito-miura-II-lavrada', 1, 1, 0, 0),
(58, '10', 'Carabina de Pressão CBC', 10, 'Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste Apenas de Teste\n\n', 7, 6, '2019-02-10 00:00:00', '2019-02-20 00:00:00', '', 8, 8, 8, 8, 8, 'carabina, carabina de pressão', 'Apenas de Teste', 'Carabina de Pressão', 'carabina-de-pressao-cbc', 1, 0, 1, 0),
(59, '20', 'Acessorios para robo', 20, 'Apoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoeded\n\n\n\n\nApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoededApoenas dekdpekdoeded', 280, 282, '2019-03-20 00:00:00', '2019-03-28 00:00:00', '10', 8, 8, 8, 8, 8, 'ythyt', 'tyhtyh', 'ythth', 'yth', 1, 0, 1, 1),
(60, '10', 'Produto Teste Correios hehe', 10, 'feefefefe', 280, 280, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Teste', 0, 20, 20, 20, 10, 'test', 'steeste', 'teste', 'ete', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_categorias`
--

CREATE TABLE `produtos_categorias` (
  `COD_PRODUTO` int(10) UNSIGNED NOT NULL,
  `COD_CATEGORIA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos_categorias`
--

INSERT INTO `produtos_categorias` (`COD_PRODUTO`, `COD_CATEGORIA`) VALUES
(56, 28),
(57, 28),
(58, 32),
(59, 28),
(60, 29),
(60, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sw_status`
--

CREATE TABLE `sw_status` (
  `COD_STATUS` int(11) NOT NULL,
  `NOME_STATUS` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sw_status`
--

INSERT INTO `sw_status` (`COD_STATUS`, `NOME_STATUS`) VALUES
(1, 'Criado'),
(2, 'Separação');

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

--
-- Extraindo dados da tabela `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`COD_TIPOPAGTO`, `NOME_TIPOPAGTO`) VALUES
(1, 'Cartão de Crédito');

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

-- --------------------------------------------------------

--
-- Structure for view `pedido_detalhado`
--
DROP TABLE IF EXISTS `pedido_detalhado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pedido_detalhado`  AS  select `ped`.`COD_PEDIDO` AS `CODIGO_PEDIDO`,`ped`.`DTA_CRIACAO_PEDIDO` AS `DTA_CRIACAO_PEDIDO`,`ped`.`VLR_FRETE_PEDIDO` AS `VLR_FRETE_PEDIDO`,`ped`.`FORMA_PAGTO_PEDIDO` AS `FORMA_PAGTO_PEDIDO`,`ped`.`STATUS_PEDIDO` AS `STATUS_PEDIDO`,(select `sw_status`.`NOME_STATUS` from `sw_status` where (`sw_status`.`COD_STATUS` = 1)) AS `DES_STATUS`,`ped`.`CLIENTE_COD_CLIENTE` AS `CLIENTE_COD_CLIENTE`,`cli`.`COD_CLIENTE` AS `CODIGO_CLIENTE`,`cli`.`NOME_CLIENTE` AS `NOME_CLIENTE`,`cli`.`CPF_CLIENTE` AS `CPF_CLIENTE`,`cli`.`DTA_CADASTRO_CLIENTE` AS `DTA_CADASTRO_CLIENTE`,`cli`.`DTA_NASCIMENTO` AS `DTA_NASCIMENTO`,`cli`.`TELEFONE_CLIENTE` AS `TELEFONE_CLIENTE`,`cli`.`CELULAR_CLIENTE` AS `CELULAR_CLIENTE`,`cli`.`EMAIL_CLIENTE` AS `EMAIL_CLIENTE`,`item`.`COD_ITEM_PEDIDO` AS `COD_ITEM_PEDIDO`,`item`.`VLR_PRODUTO` AS `VLR_PRODUTO`,`item`.`QTD_PRODUTO` AS `QTD_PRODUTO`,`item`.`COD_PRODUTO` AS `COD_PRODUTO`,`item`.`COD_PEDIDO` AS `COD_PEDIDO`,`prod`.`EAN_PRODUTO` AS `EAN_PRODUTO`,`prod`.`NOME_PRODUTO` AS `NOME_PRODUTO`,`prod`.`PRECO_PROMO_PRODUTO` AS `PRECO_PROMO_PRODUTO`,`ender`.`COD_ENDERECO` AS `COD_ENDERECO`,`ender`.`CEP_ENDERECO` AS `CEP_ENDERECO`,`ender`.`LOGRADOURO_ENDERECO` AS `LOGRADOURO_ENDERECO`,`ender`.`NUMERO_ENDERECO` AS `NUMERO_ENDERECO`,`ender`.`CIDADE_ENDERECO` AS `CIDADE_ENDERECO`,`ender`.`ESTADO_ENDERECO` AS `ESTADO_ENDERECO`,`ender`.`BAIRRO_ENDERECO` AS `BAIRRO_ENDERECO`,`ender`.`COMPLEMENTO_ENDERECO` AS `COMPLEMENTO_ENDERECO`,`ender`.`TIP_ENTREGA` AS `TIP_ENTREGA`,`ender`.`COD_CLIENTE` AS `COD_CLIENTE` from ((((`pedido` `ped` join `pedido_itens` `item` on((`ped`.`COD_PEDIDO` = `item`.`COD_PEDIDO`))) join `produto` `prod` on((`prod`.`EAN_PRODUTO` = `item`.`COD_PRODUTO`))) join `cliente` `cli` on((`ped`.`CLIENTE_COD_CLIENTE` = `cli`.`COD_CLIENTE`))) join `enderecos` `ender` on((`ender`.`COD_CLIENTE` = `cli`.`COD_CLIENTE`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`COD_AVALIACAO`),
  ADD KEY `FK_COD_CLIENTE` (`COD_CLIENTE`);

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
-- Indexes for table `configuracoes_correios`
--
ALTER TABLE `configuracoes_correios`
  ADD PRIMARY KEY (`COD_CONFIG`);

--
-- Indexes for table `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`COD_CUPOM`);

--
-- Indexes for table `dados_empresa`
--
ALTER TABLE `dados_empresa`
  ADD PRIMARY KEY (`COD_DADO`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`COD_ENDERECO`),
  ADD KEY `FK_COD_CLIENTE` (`COD_CLIENTE`);

--
-- Indexes for table `fotos_produtos`
--
ALTER TABLE `fotos_produtos`
  ADD PRIMARY KEY (`COD_FOTO_PRODUTO`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`COD_MARCA`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`COD_ORCAMENTO`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`COD_PAGAMENTO`);

--
-- Indexes for table `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`COD_PAGINA`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`COD_PEDIDO`);

--
-- Indexes for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`COD_ITEM_PEDIDO`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`COD_PRODUTO`,`COD_MARCA`);

--
-- Indexes for table `produtos_categorias`
--
ALTER TABLE `produtos_categorias`
  ADD PRIMARY KEY (`COD_PRODUTO`,`COD_CATEGORIA`);

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
-- AUTO_INCREMENT for table `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `COD_AVALIACAO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `COD_BANER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `COD_CATEGORIA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `COD_CLIENTE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `configuracoes_correios`
--
ALTER TABLE `configuracoes_correios`
  MODIFY `COD_CONFIG` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cupons`
--
ALTER TABLE `cupons`
  MODIFY `COD_CUPOM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dados_empresa`
--
ALTER TABLE `dados_empresa`
  MODIFY `COD_DADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `COD_ENDERECO` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fotos_produtos`
--
ALTER TABLE `fotos_produtos`
  MODIFY `COD_FOTO_PRODUTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `COD_MARCA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `COD_ORCAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `COD_PAGAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `COD_PAGINA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `COD_PEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `COD_ITEM_PEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `COD_PRODUTO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `sw_status`
--
ALTER TABLE `sw_status`
  MODIFY `COD_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `COD_TIPOPAGTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `cliente` (`COD_CLIENTE`);

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `FK_COD_CLIENTE` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `cliente` (`COD_CLIENTE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
