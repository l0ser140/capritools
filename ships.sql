TRUNCATE TABLE capritools.ships;
INSERT INTO capritools.ships
SELECT typeID, typeName, invGroups.groupID, invGroups.groupName, invCategories.categoryID, invCategories.categoryName, mass, volume, marketGroupID
FROM invTypes
INNER JOIN invGroups on invTypes.groupID=invGroups.groupID
INNER JOIN invCategories on invGroups.categoryID=invCategories.categoryID
WHERE invCategories.categoryID=6;