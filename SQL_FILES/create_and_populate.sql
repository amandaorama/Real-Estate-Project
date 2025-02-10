-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: real_estate
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Table structure for table Agent

DROP TABLE IF EXISTS Agent;
CREATE TABLE Agent (
  agentId int(11) NOT NULL,
  name varchar(30) NOT NULL,
  phone char(12) NOT NULL,
  firmId int(11) DEFAULT NULL,
  dateStarted date DEFAULT NULL,
  PRIMARY KEY (agentId),
  KEY fk_agent_firmId (firmId),
  CONSTRAINT agent_ibfk_1 FOREIGN KEY (firmId) REFERENCES firm (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES Agent WRITE;
INSERT INTO Agent VALUES 
  (1, 'Alice Smith', '123-456-7890', 1, '2023-06-01'),
  (2, 'Bob Johnson', '987-654-3210', 2, '2022-05-10'),
  (3, 'Charlie Brown', '555-678-1234', 3, '2021-03-15'),
  (4, 'David White', '444-321-7654', 4, '2020-07-20'),
  (5, 'Eva Green', '333-432-6789', 5, '2019-11-01');
UNLOCK TABLES;

-- Table structure for table BusinessProperty

DROP TABLE IF EXISTS BusinessProperty;
CREATE TABLE BusinessProperty (
  type char(20) NOT NULL,
  size int(11) NOT NULL,
  address varchar(50) NOT NULL,
  PRIMARY KEY (address),
  CONSTRAINT businessproperty_ibfk_1 FOREIGN KEY (address) REFERENCES Property (address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES BusinessProperty WRITE;
INSERT INTO BusinessProperty VALUES 
  ('Office', 3000, '101 Corporate Plaza'),
  ('Retail', 3500, '200 Business Blvd'),
  ('Retail', 1500, '450 Mall Street'),
  ('Retail', 2000, '789 Downtown Avenue'),
  ('Office', 2500, '123 Executive Way');
UNLOCK TABLES;

-- Table structure for table Buyer


DROP TABLE IF EXISTS Buyer;
CREATE TABLE Buyer (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  phone char(12) NOT NULL,
  propertyType char(20) DEFAULT NULL,
  bedrooms int(11) DEFAULT NULL,
  bathrooms int(11) DEFAULT NULL,
  businessPropertyType char(20) DEFAULT NULL,
  minimumPreferredPrice int(11) DEFAULT NULL,
  maximumPreferredPrice int(11) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES Buyer WRITE;
INSERT INTO Buyer (name, phone, propertyType, bedrooms, bathrooms, businessPropertyType, minimumPreferredPrice, maximumPreferredPrice) VALUES
  ('Alice Green', '555-123-7890', 'House', 3, 2, NULL, 200000, 500000),
  ('Bob White', '555-456-1234', 'House', 2, 1, NULL, 150000, 300000),
  ('Charlie Black', '555-789-2345', 'House', 4, 3, NULL, 500000, 700000),
  ('David Blue', '555-234-5678', 'House', 3, 2, NULL, 400000, 600000),
  ('Eva Red', '555-345-6789', 'House', 2, 2, NULL, 250000, 450000),
  ('Frank Yellow', '555-432-8765', 'BusinessProperty', NULL, NULL, 'Office', 100000, 500000),
  ('Grace Violet', '555-567-1234', 'BusinessProperty', NULL, NULL, 'Retail', 150000, 400000);
UNLOCK TABLES;


-- Table structure for table House

DROP TABLE IF EXISTS House;
CREATE TABLE House (
  bedrooms int(11) NOT NULL,
  bathrooms int(11) NOT NULL,
  size int(11) NOT NULL,
  address varchar(50) NOT NULL,
  PRIMARY KEY (address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES House WRITE;
INSERT INTO House VALUES 
  (3, 2, 1800, '456 Maple Road'),
  (3, 2, 1500, '789 Oak Street'),
  (2, 1, 900, '12 Pine Lane'),
  (4, 3, 2000, '300 Rose Avenue'),
  (3, 2, 1700, '101 River Road');
UNLOCK TABLES;

-- Table structure for table Listings

DROP TABLE IF EXISTS Listings;
CREATE TABLE Listings (
  mlsNumber int(11) NOT NULL,
  address varchar(50) DEFAULT NULL,
  agentId int(11) DEFAULT NULL,
  dateListed date DEFAULT NULL,
  PRIMARY KEY (mlsNumber)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES Listings WRITE;
INSERT INTO Listings VALUES 
  (101, '456 Maple Road', 1, '2024-01-15'),
  (102, '789 Oak Street', 2, '2023-12-01'),
  (103, '12 Pine Lane', 3, '2024-02-01'),
  (104, '300 Rose Avenue', 4, '2024-03-05'),
  (105, '101 River Road', 5, '2023-11-20'),
  (106, '101 Corporate Plaza', 1, '2024-01-10'),
  (107, '200 Business Blvd', 2, '2023-10-15'),
  (108, '450 Mall Street', 3, '2023-11-05'),
  (109, '789 Downtown Avenue', 4, '2023-09-01'),
  (110, '123 Executive Way', 5, '2023-08-20');
UNLOCK TABLES;

-- Table structure for table Property

DROP TABLE IF EXISTS Property;
CREATE TABLE Property (
  address varchar(50) NOT NULL,
  ownerName varchar(30) NOT NULL,
  price decimal(12,2) NOT NULL,
  PRIMARY KEY (address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES Property WRITE;
INSERT INTO Property VALUES 
  ('456 Maple Road', 'Tom White', 450000.00),
  ('789 Oak Street', 'John Doe', 250000.00),
  ('12 Pine Lane', 'Jane Smith', 150000.00),
  ('300 Rose Avenue', 'Sara Green', 300000.00),
  ('101 River Road', 'Sam Brown', 750000.00),
  ('101 Corporate Plaza', 'Alex Green', 350000.00),
  ('200 Business Blvd', 'Emily Clark', 450000.00),
  ('450 Mall Street', 'David Lee', 200000.00),
  ('789 Downtown Avenue', 'Linda Davis', 550000.00),
  ('123 Executive Way', 'Michael Harris', 600000.00);
UNLOCK TABLES;

-- Table structure for table Works_With

DROP TABLE IF EXISTS Works_With;
CREATE TABLE Works_With (
  buyerId int(11) NOT NULL,
  agentId int(11) NOT NULL,
  PRIMARY KEY (buyerId, agentId),
  CONSTRAINT fk_buyer_agent FOREIGN KEY (buyerId) REFERENCES Buyer (id),
  CONSTRAINT fk_agent_buyer FOREIGN KEY (agentId) REFERENCES Agent (agentId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES Works_With WRITE;
INSERT INTO Works_With VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5),
  (6, 1),
  (7, 2);
UNLOCK TABLES;


DROP TABLE IF EXISTS firm;
CREATE TABLE firm (
  id int(11) NOT NULL,
  name varchar(30) NOT NULL,
  address varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES firm WRITE;
INSERT INTO firm VALUES 
  (1, 'Acme Realty', '789 Market Avenue'),
  (2, 'Green Properties', '101 Pine Road'),
  (3, 'Blue Sky Realtors', '123 Maple Street'),
  (4, 'Sunset Realty', '45 Elm Street'),
  (5, 'Lakeside Realty', '456 Oak Drive');
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;