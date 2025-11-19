-- =====================================================
-- SCHEMA: el_gol_del_sabor
-- =====================================================
CREATE SCHEMA IF NOT EXISTS `el_gol_del_sabor` DEFAULT CHARACTER SET utf8mb4;
USE `el_gol_del_sabor`;

-- =====================================================
-- TABLE: usuario
-- =====================================================
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `contraseña` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: log
-- =====================================================
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` INT NOT NULL AUTO_INCREMENT,
  `accion` VARCHAR(100) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `fecha_hora` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` INT NULL,
  PRIMARY KEY (`id_log`),
  INDEX `fk_log_usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_log_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: descuento (versión corregida con campo codigo)
-- =====================================================
CREATE TABLE IF NOT EXISTS `descuento` (
  `id_descuento` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(50) NULL,                        -- Código del cupón (NULL si no aplica)
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NULL,
  `tipo` ENUM('porcentaje','fijo') NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `ambito` ENUM('pedido','producto') NOT NULL,
  PRIMARY KEY (`id_descuento`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =====================================================
-- TABLE: pedido
-- =====================================================
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `direccion_pedido` VARCHAR(100) NULL,
  `estado` VARCHAR(45) NOT NULL,
  `tipo_entrega` VARCHAR(45) NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_descuento` INT NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `fk_usuario_pedido_idx` (`id_usuario` ASC),
  INDEX `fk_descuento_pedido_idx` (`id_descuento` ASC),
  CONSTRAINT `fk_usuario_pedido`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `usuario` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_descuento_pedido`
    FOREIGN KEY (`id_descuento`)
    REFERENCES `descuento` (`id_descuento`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: producto
-- =====================================================
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `id_descuento` INT NULL,
  PRIMARY KEY (`id_producto`),
  INDEX `fk_descuento_producto_idx` (`id_descuento` ASC),
  CONSTRAINT `fk_descuento_producto`
    FOREIGN KEY (`id_descuento`)
    REFERENCES `descuento` (`id_descuento`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: linea_pedido
-- =====================================================
CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `id_linea_pedido` INT NOT NULL AUTO_INCREMENT,
  `id_pedido` INT NOT NULL,
  `id_producto` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio_unitario` DECIMAL(10,2) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_linea_pedido`),
  INDEX `fk_producto_linea_pedido_idx` (`id_producto` ASC),
  CONSTRAINT `fk_pedido_linea_pedido`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `pedido` (`id_pedido`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_linea_pedido`
    FOREIGN KEY (`id_producto`)
    REFERENCES `producto` (`id_producto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: ingrediente
-- =====================================================
CREATE TABLE IF NOT EXISTS `ingrediente` (
  `id_ingrediente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `coste` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_ingrediente`)
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: ingrediente_has_linea_pedido
-- =====================================================
CREATE TABLE IF NOT EXISTS `ingrediente_has_linea_pedido` (
  `ingrediente_id_ingrediente` INT NOT NULL,
  `linea_pedido_id_linea_pedido` INT NOT NULL,
  `accion` VARCHAR(45) NOT NULL,
  `cantidad` INT NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`ingrediente_id_ingrediente`, `linea_pedido_id_linea_pedido`),
  INDEX `fk_ingrediente_has_linea_pedido_linea_pedido1_idx` (`linea_pedido_id_linea_pedido` ASC),
  CONSTRAINT `fk_ingrediente_has_linea_pedido_ingrediente1`
    FOREIGN KEY (`ingrediente_id_ingrediente`)
    REFERENCES `ingrediente` (`id_ingrediente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ingrediente_has_linea_pedido_linea_pedido1`
    FOREIGN KEY (`linea_pedido_id_linea_pedido`)
    REFERENCES `linea_pedido` (`id_linea_pedido`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: ingrediente_has_producto
-- =====================================================
CREATE TABLE IF NOT EXISTS `ingrediente_has_producto` (
  `ingrediente_id_ingrediente` INT NOT NULL,
  `producto_id_producto` INT NOT NULL,
  `defecto` TINYINT NOT NULL,
  `precio_extra` DECIMAL(10,2) NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`ingrediente_id_ingrediente`, `producto_id_producto`),
  CONSTRAINT `fk_ingrediente_has_producto_ingrediente1`
    FOREIGN KEY (`ingrediente_id_ingrediente`)
    REFERENCES `ingrediente` (`id_ingrediente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ingrediente_has_producto_producto1`
    FOREIGN KEY (`producto_id_producto`)
    REFERENCES `producto` (`id_producto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: categoria
-- =====================================================
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `categoria_padre` INT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  CONSTRAINT `fk_categoria_padre`
    FOREIGN KEY (`categoria_padre`)
    REFERENCES `categoria` (`id_categoria`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: categoria_has_producto
-- =====================================================
CREATE TABLE IF NOT EXISTS `categoria_has_producto` (
  `categoria_id_categoria` INT NOT NULL,
  `producto_id_producto` INT NOT NULL,
  PRIMARY KEY (`categoria_id_categoria`, `producto_id_producto`),
  CONSTRAINT `fk_categoria_has_producto_categoria1`
    FOREIGN KEY (`categoria_id_categoria`)
    REFERENCES `categoria` (`id_categoria`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_categoria_has_producto_producto1`
    FOREIGN KEY (`producto_id_producto`)
    REFERENCES `producto` (`id_producto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: alergeno
-- =====================================================
CREATE TABLE IF NOT EXISTS `alergeno` (
  `id_alergeno` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `icono` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_alergeno`)
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: alergeno_has_ingrediente
-- =====================================================
CREATE TABLE IF NOT EXISTS `alergeno_has_ingrediente` (
  `alergeno_id_alergeno` INT NOT NULL,
  `ingrediente_id_ingrediente` INT NOT NULL,
  PRIMARY KEY (`alergeno_id_alergeno`, `ingrediente_id_ingrediente`),
  CONSTRAINT `fk_alergeno_has_ingrediente_alergeno1`
    FOREIGN KEY (`alergeno_id_alergeno`)
    REFERENCES `alergeno` (`id_alergeno`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_alergeno_has_ingrediente_ingrediente1`
    FOREIGN KEY (`ingrediente_id_ingrediente`)
    REFERENCES `ingrediente` (`id_ingrediente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB;
