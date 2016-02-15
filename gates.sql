TRUNCATE TABLE capritools.gates;
INSERT INTO capritools.gates
SELECT invNames.itemID, invNames.itemName, invTypes.typeID, s.itemID as systemID, s.itemName as systemName, 
c.itemID as constellationID, c.itemName as constellationName, r.itemID as regionID, r.itemName as regionName,
invTypes.typeName, invTypes.mass, invTypes.volume, invGroups.groupID, invGroups.groupName, invCategories.categoryID, invCategories.categoryName
FROM invNames
INNER JOIN mapDenormalize on mapDenormalize.itemID=invNames.itemID
INNER JOIN invGroups on mapDenormalize.groupID=invGroups.groupID
INNER JOIN invTypes on invTypes.typeID=mapDenormalize.typeID
INNER JOIN invNames as s on s.itemID=mapDenormalize.solarSystemID
INNER JOIN invNames as c on c.itemID=mapDenormalize.constellationID
INNER JOIN invNames as r on r.itemID=mapDenormalize.regionID
INNER JOIN invCategories on invCategories.categoryID = invGroups.categoryID
where mapDenormalize.groupID = 10
GROUP BY itemName
HAVING COUNT(*) = 1;