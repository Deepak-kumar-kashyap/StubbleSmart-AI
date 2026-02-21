CREATE DATABASE IF NOT EXISTS stubblesmart;
USE stubblesmart;

CREATE TABLE IF NOT EXISTS stubbles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    confidence FLOAT NOT NULL,
    status ENUM('pending', 'verified', 'collected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
