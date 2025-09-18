CREATE TABLE IF NOT EXISTS brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(255) NOT NULL,
    brand_image VARCHAR(255) NOT NULL,
    rating TINYINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    country CHAR(2) DEFAULT 'XX'
);

INSERT INTO brands (brand_name, brand_image, rating, country)
SELECT * FROM (SELECT 'Apple', 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg', 5, 'US') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM brands WHERE brand_name='Apple') LIMIT 1;

INSERT INTO brands (brand_name, brand_image, rating, country)
SELECT * FROM (SELECT 'Nike', 'https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg', 4, 'US') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM brands WHERE brand_name='Nike') LIMIT 1;

INSERT INTO brands (brand_name, brand_image, rating, country)
SELECT * FROM (SELECT 'Adidas', 'https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg', 4, 'DE') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM brands WHERE brand_name='Adidas') LIMIT 1;
