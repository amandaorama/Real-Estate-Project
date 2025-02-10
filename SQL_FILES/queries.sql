-- ===========================
-- 1. Find the addresses of all houses currently listed
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT DISTINCT h.address
FROM House h
JOIN Listings l ON h.address = l.address;

-- ===========================
-- 2. Find the addresses and MLS numbers of all houses currently listed
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT l.mlsNumber, h.address
FROM Listings l
JOIN House h ON l.address = h.address;

-- ===========================
-- 3. Find the addresses of all 3-bedroom, 2-bathroom houses currently listed
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT DISTINCT h.address 
FROM House h
JOIN Listings l ON h.address = l.address 
WHERE h.bedrooms = 3 AND h.bathrooms = 2;

-- ===========================
-- 4. Find the addresses and prices of all 3-bedroom, 2-bathroom houses with prices in the range $100,000 to $250,000
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT h.address, p.price
FROM House h
JOIN Listings l ON h.address = l.address
JOIN Property p ON h.address = p.address
WHERE h.bedrooms = 3 AND h.bathrooms = 2
AND p.price BETWEEN 100000 AND 250000
ORDER BY p.price DESC;

-- ===========================
-- 5. Find the addresses and prices of all business properties that are advertised as office space in descending order of price
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT bp.address, p.price
FROM BusinessProperty bp
JOIN Property p ON bp.address = p.address
WHERE bp.type = 'Office'
ORDER BY p.price DESC;

-- ===========================
-- 6. Find all the ids, names, and phones of all agents, together with the names of their firms and the dates when they started
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT a.agentId, a.name AS agent_name, a.phone, f.name AS firm_name, a.dateStarted
FROM Agent a
LEFT JOIN Firm f ON a.firmId = f.id;

-- ===========================
-- 7. Find all the properties currently listed by agent with id "001"
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT p.address
FROM Listings l
JOIN Property p ON l.address = p.address
WHERE l.agentId = 1;

-- ===========================
-- 8. Find all Agent.name-Buyer.name pairs where the buyer works with the agent, sorted alphabetically by Agent.name
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT a.name AS agent_name, b.name AS buyer_name
FROM Works_With ww
JOIN Agent a ON ww.agentId = a.agentId
JOIN Buyer b ON ww.buyerId = b.id
ORDER BY a.name, b.name;

-- ===========================
-- 9. For each agent, find the total number of buyers currently working with that agent
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT a.agentId, COUNT(ww.buyerId) AS total_buyers
FROM Agent a
LEFT JOIN Works_With ww ON a.agentId = ww.agentId
GROUP BY a.agentId;

-- ===========================
-- 10. Find all houses that meet the buyer's preferences, with the results shown in descending order of price
-- ===========================
SELECT ' ' AS spacer;  -- Blank line
SELECT h.address, p.price
FROM House h
JOIN Property p ON h.address = p.address
JOIN Buyer b ON b.propertyType = 'House'  -- Only interested in houses
WHERE b.id = 1  -- or use any buyerId you want to test
AND h.bedrooms >= b.bedrooms
AND h.bathrooms >= b.bathrooms
AND p.price BETWEEN b.minimumPreferredPrice AND b.maximumPreferredPrice
ORDER BY p.price DESC;

