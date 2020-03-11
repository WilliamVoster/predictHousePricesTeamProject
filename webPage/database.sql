use thePriceIsRight;

drop table if exists `houseData`;

create table `houseData` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    LotArea smallint(3),
    Street VARCHAR(5),
    LotShape VARCHAR(4),
    Neighborhood VARCHAR(16),
    HouseStyle VARCHAR(10),
    OverallQual smallint(2),
    OverallCond smallint(2),
    YearBuilt smallint(4) unsigned,
    RoofStyle VARCHAR(10),
    BsmtQual VARCHAR(4),
    BsmtCond VARCHAR(4),
    GrLivArea smallint(4) unsigned,
    FullBath smallint(1) unsigned,
    HalfBath smallint(1) unsigned,
    BedroomAbvGr smallint(1) unsigned,
    KitchenAbvGr smallint(1) unsigned,
    KitchenQual VARCHAR(4),
    Fireplaces smallint(1) unsigned,
    GarageType VARCHAR(6),
    GarageYrBlt smallint(4) unsigned,
    GarageFinish VARCHAR(4),
    GarageCars smallint(1) unsigned,
    GarageArea smallint(3) unsigned,
    GarageQual varchar(3),
    GarageCond varchar(3),
    PavedDrive varchar(2),
    MoSold smallint(2) unsigned,
    YrSold smallint(4) unsigned,
    SaleType varchar(3),
    SaleCondition varchar(6)
);