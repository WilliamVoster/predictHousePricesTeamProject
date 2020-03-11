<?php
    require("database.php");
    $conn = connect();

    // echo var_dump($_POST);

    if(isset($_POST["submitted"])){
        if($_POST["submitted"] == "yes"){
            // echo var_dump(clearDB($conn));
            clearDB($conn);
            insert($conn, $_POST);
            
        }
    }

    // echo exec("python script.py");

    // $result = retrieve($conn);

    // echo var_dump($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Predict house price</title>
</head>
<body>

    <a href="./index.php"> HOME </a>

    <h1>The Price Is Right - House price prediction</h1>

    <h2>Fill inn information about house</h2>
    <form action="./index.php" method="POST">
        <label for="LotArea">LotArea</label>
        <input type="text" id="LotArea" name="LotArea">
        <label for="Street">Select option for street</label>
        <select id="Street" name="Street">
            <option value="NaN">NaN</option>
            <option value="Pave">Pave</option>
            <option value="Gravel">Gravel</option>
        </select>
        <label for="LotShape">Select option for LotShape</label>
        <select id="LotShape" name="LotShape">
            <option value="NaN">NaN</option>
            <option value="Reg">Reg</option>
            <option value="IR1">IR1</option>
            <option value="IR2">IR2</option>
            <option value="IR3">IR3</option>
        </select>
        <label for="Neighboorhood">Select option for Neighboorhood</label>
        <select id="Neighboorhood" name="Neighboorhood">
            <option value="NaN">NaN</option>
            <option value="CollgCr">CollgCr</option>
            <option value="Veenker">Veenker</option>
            <option value="Crawfor">Crawfor</option>
            <option value="NoRidge">NoRidge</option>
            <option value="MeadowV">MeadowV</option>
            <option value="Mitchel">Mitchel</option>
        </select>

        <label for="HouseStyle">Select option for HouseStyle</label>
        <select id="HouseStyle" name="HouseStyle">
            <option value="NaN">NaN</option>
            <option value="1Story">1Story</option>
            <option value="2Story">2Story</option>
            <option value="SFoyer">SFoyer</option>
        </select>

        <label for="OverallQual">Select option for OverallQual</label>
        <select id="OverallQual" name="OverallQual">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>

        <label for="OverallCond">Select option for OverallCond</label>
        <select id="OverallCond" name="OverallCond">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>

        <label for="YearBuilt">YearBuilt</label>
        <input type="text" id="YearBuilt" name="YearBuilt">

        <label for="RoofStyle">Select option for RoofStyle</label>
        <select id="RoofStyle" name="RoofStyle">
            <option value="NaN">NaN</option>
            <option value="Gable">Gable</option>
            <option value="Hip">Hip</option>
            <option value="Mansard">Mansard</option>
            <option value="Gambrel">Gambrel</option>
            <option value="Flat">Flat</option>
            <option value="Shed">Shed</option>
        </select>

        <label for="BsmtQual">Select option for BsmtQual</label>
        <select id="BsmtQual" name="BsmtQual">
            <option value="NaN">NaN</option>
            <option value="Gd">Gd</option>
            <option value="TA">TA</option>
            <option value="Ex">Ex</option>
            <option value="Fa">Fa</option>
        </select>

        <label for="BsmtCond">Select option for BsmtCond</label>
        <select id="BsmtCond" name="BsmtCond">
            <option value="NaN">NaN</option>
            <option value="Gd">Gd</option>
            <option value="TA">TA</option>
            <option value="Ex">Ex</option>
            <option value="Fa">Fa</option>
        </select>

        <label for="GrLivArea">GrLivArea</label>
        <input type="text" id="GrLivArea" name="GrLivArea">

        <label for="FullBath">Select option for FullBath</label>
        <select id="FullBath" name="FullBath">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>


        <label for="HalfBath">Select option for HalfBath</label>
        <select id="HalfBath" name="HalfBath">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <label for="BedroomAbvGr">Select option for BedroomAbvGr</label>
        <select id="BedroomAbvGr" name="BedroomAbvGr">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>

        <label for="KitchenAbvGr">Select option for KitchenAbvGr</label>
        <select id="KitchenAbvGr" name="KitchenAbvGr">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>


        <label for="KitchenQual">Select option for KitchenQual</label>
        <select id="KitchenQual" name="KitchenQual">
            <option value="NaN">NaN</option>
            <option value="Gd">Gd</option>
            <option value="TA">TA</option>
            <option value="Ex">Ex</option>
            <option value="Fa">Fa</option>
        </select>


        <label for="Fireplaces">Select option for Fireplaces</label>
        <select id="Fireplaces" name="Fireplaces">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <label for="GarageType">Select option for GarageType</label>
        <select id="GarageType" name="GarageType">
            <option value="NaN">NaN</option>
            <option value="Attchd">Attchd</option>
            <option value="BuiltIn">BuiltIn</option>
            <option value="CarPort">CarPort</option>
            <option value="Basment">Basment</option>
            <option value="2Types">2Types</option>
        </select>

        <label for="GarageYrBlt">GarageYrBlt</label>
        <input type="text" id="GarageYrBlt" name="GarageYrBlt">

        <label for="GarageFinish">Select option for GarageFinish</label>
        <select id="GarageFinish" name="GarageFinish">
            <option value="NaN">NaN</option>
            <option value="Fin">Fin</option>
            <option value="Unf">Unf</option>
            <option value="RFn">RFn</option>
        </select>

        <label for="GarageCars">Select option for GarageCars</label>
        <select id="GarageCars" name="GarageCars">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="GarageQual">Select option for GarageQual</label>
        <select id="GarageQual" name="GarageQual">
            <option value="NaN">NaN</option>
            <option value="Gd">Gd</option>
            <option value="TA">TA</option>
            <option value="Ex">Ex</option>
            <option value="Fa">Fa</option>
            <option value="Po">Po</option>
        </select>

        <label for="GarageCond">Select option for GarageCond</label>
        <select id="GarageCond" name="GarageCond">
            <option value="NaN">NaN</option>
            <option value="Gd">Gd</option>
            <option value="TA">TA</option>
            <option value="Ex">Ex</option>
            <option value="Fa">Fa</option>
        </select>

        <label for="PavedDrive">Select option for PavedDrive</label>
        <select id="PavedDrive" name="PavedDrive">
            <option value="Y">Y</option>
            <option value="N">N</option>
            <option value="P">P</option>
        </select>

        <label for="MoSold">Select option for MoSold</label>
        <select id="MoSold" name="MoSold">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>


        <label for="YrSold">Select option for YrSold</label>
        <select id="YrSold" name="YrSold">
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
        </select>

        <label for="SaleType">Select option for SaleType</label>
        <select id="SaleType" name="SaleType">
            <option value="NaN">NaN</option>
            <option value="WD">WD</option>
            <option value="New">New</option>
            <option value="COD">COD</option>
            <option value="ConLD">ConLD</option>
            <option value="ConLI">ConLI</option>
            <option value="ConLw">ConLw</option>
            <option value="CWD">CWD</option>
            <option value="Con">Con</option>
            <option value="Oth">Oth</option>
        </select>

        <label for="SaleCondition">Select option for SaleCondition</label>
        <select id="SaleCondition" name="SaleCondition">
            <option value="Normal">Normal</option>
            <option value="Abnorml">Abnorml</option>
            <option value="Partial">Partial</option>
            <option value="AdjLand">AdjLand</option>
            <option value="Alloca">Alloca</option>
            <option value="Family">Family</option>
        </select>

        <label for="GarageArea">GarageArea</label>
        <input type="text" id="GarageArea" name="GarageArea">

        <input type="hidden" name="submitted" value="yes">
        <input type="submit" value="Generate prediction">
    </form>
    
    <h2 id="price">Predicted house price: 
        <?php
        if(isset($_POST["submitted"])){
            if($_POST["submitted"] == "yes"){
                echo exec("python script.py");
            }
        }?>
    </h2>
</body>
</html>