## Buat Database di phpMySQL
CREATE DATABASE kalkulator_db;

## Lalu Buat Tabel
CREATE TABLE history_ohm (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tegangan FLOAT,
    arus FLOAT,
    resistansi FLOAT,
    hasil VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `history_resistor_seri` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `resistor_values` VARCHAR(255) NOT NULL,
  `total_resistance` DOUBLE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
CREATE TABLE history_resistor_paralel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resistors VARCHAR(255) NOT NULL,
    total DOUBLE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

## Setela itu jalankan printah : http://localhost/kalkulator-elektronika/index.php?page=home