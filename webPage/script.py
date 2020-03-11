# pip install pandas
# pip install sklearn
# pip install xgboost
# pip install seaborn
# pip install mysql.connector     //maybe mysql first then ...


import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
from sklearn.metrics import mean_squared_error
import xgboost as xgb
import seaborn as sns
import statistics
import math

## annoying error handling :(
pd.options.mode.chained_assignment = None

train   = pd.read_csv("https://raw.githubusercontent.com/WilliamVoster/predictHousePricesTeamProject/master/house-prices-advanced-regression-techniques/train.csv")
test    = pd.read_csv("https://raw.githubusercontent.com/WilliamVoster/predictHousePricesTeamProject/master/house-prices-advanced-regression-techniques/test.csv")
sample  = pd.read_csv("https://raw.githubusercontent.com/WilliamVoster/predictHousePricesTeamProject/master/house-prices-advanced-regression-techniques/sample_submission.csv")



# Combining all the tables into one!
b = [i for i in sample["SalePrice"].tolist()]
a = pd.DataFrame({"SalePrice": b}, index=sample["Id"].tolist())
d = [i for i in test["Id"]]
test.index = d
testWithSalePrice = pd.concat([test, a], axis=1, sort=False)
fullData = pd.concat([train, testWithSalePrice], sort=False)



## FROM OUR WEBISTE

import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="thepriceisright"
)

mycursor = mydb.cursor()

mycursor.execute("SELECT * FROM housedata")

myresult = mycursor.fetchall()

  
columnsFromDB = [
    "id",
    "LotArea",
    "Street",
    "LotShape",
    "Neighborhood",
    "HouseStyle",
    "OverallQual",
    "OverallCond",
    "YearBuilt",
    "RoofStyle",
    "BsmtQual",
    "BsmtCond",
    "GrLivArea",
    "FullBath",
    "HalfBath",
    "BedroomAbvGr",
    "KitchenAbvGr",
    "KitchenQual",
    "Fireplaces",
    "GarageType",
    "GarageYrBlt",
    "GarageFinish",
    "GarageCars",
    "GarageArea",
    "GarageQual",
    "GarageCond",
    "PavedDrive",
    "MoSold",
    "YrSold",
    "SaleType",
    "SaleCondition"
]


# print(fullData)
testHouse = fullData.iloc[0]
testHouse["Id"] = 2920


for x in myresult:
    # print(x)
    for i in range(len(x)):
        if(x[i] != None and columnsFromDB[i] != "id"):
            # print(x[i],  columnsFromDB[i])
            # testHouse.at[2920, columnsFromDB[i]] =  x[i]
            testHouse.at[columnsFromDB[i]] = x[i]
            # testHouse[i] = x[i]


fullData = fullData.append(testHouse, ignore_index=True)
# print(fullData)


##

fullData = fullData.drop(labels="Alley", axis="columns")
fullData = fullData.drop(labels="Fence", axis="columns")
fullData = fullData.drop(labels="FireplaceQu", axis="columns")
fullData = fullData.drop(labels="PoolQC", axis="columns")
fullData = fullData.drop(labels="PoolArea", axis="columns")
fullData = fullData.drop(labels="MiscFeature", axis="columns")

type1 = ""
type2 = ""
for i in fullData.columns:
  dataType = type(fullData[i][0])
  
  if type1 != dataType:
      type1 = dataType
  else:
    type2 = dataType

# print(type1, type2)

type1Arr = []
type2Arr = []

for i in fullData.columns:
  nanVals = fullData[i].isnull().sum()
  dataType = type(fullData[i][0])
  
  if nanVals > 0 :
    # print(i, "\t", nanVals, "\t", dataType)

    if dataType == type1:
      type1Arr.append(i)
    if dataType == type2:
      type2Arr.append(i)
    
# print(type1, type1Arr)
# print(type2, type2Arr)

fullData.reset_index(drop=True, inplace=True)

tempCol = ""
arrOfIdsToRemove = [None] * len(type1Arr)
for i in range(len(type1Arr)):
  tempCol = fullData[type1Arr[i]].isnull()
  #print(i)
  arrOfIdsToRemove[i] = []
  tempMean = fullData[type1Arr[i]].mean()
  for j in range(len(fullData[type1Arr[i]])):
    if tempCol[j]:
      #print(j, tempCol[j], fullData[type1Arr[i]][j], fullData[type1Arr[i]].mean())
      fullData[type1Arr[i]][j] = tempMean
      arrOfIdsToRemove[i].append(j)


r = []
tempCol = ""
arrOfIdsToRemove = [None] * len(type2Arr)
for i in range(len(type2Arr)):
  tempCol = fullData[type2Arr[i]].isnull()
  arrOfIdsToRemove[i] = []
  tempMode = statistics.mode(fullData[type2Arr[i]])
  for k in fullData[type2Arr[i]]:
    r.append(k)
  for j in range(len(fullData[type2Arr[i]])):
    if tempCol[j]:
      #print(j, fullData[type2Arr[i]], tempCol[j], fullData[type2Arr[i]][j])#, fullData[type2Arr[i]].mode())
      fullData[type2Arr[i]][j] = tempMode
      arrOfIdsToRemove[i].append(j)

listOfNumericAttributes = ["MSSubClass", "LotFrontage", "LotArea", "OverallQual", "OverallCond", "MasVnrArea", "BsmtFinSF1", "BsmtFinSF2", "BsmtUnfSF", "TotalBsmtSF", "1stFlrSF", "2ndFlrSF", "LowQualFinSF", "GrLivArea", "BsmtFullBath", "BsmtHalfBath", "FullBath", "HalfBath", "BedroomAbvGr", "BedroomAbvGr", "TotRmsAbvGrd", "Fireplaces", "GarageYrBlt", "GarageCars", "GarageArea", "WoodDeckSF", "OpenPorchSF", "EnclosedPorch", "3SsnPorch", "ScreenPorch", "PoolArea", "MiscVal", "MoSold", "YrSold", "SalePrice"]
categoricalAttributes = []
for x in fullData.columns:
  if x not in listOfNumericAttributes and x != "Id":
    categoricalAttributes.append(x)
#print(categoricalAttributes)
#fullData[categoricalAttributes]

fullData = pd.get_dummies(fullData)


# 70 30 ratio of train and test

numTrain = math.floor(len(fullData) * 0.7)
numTest = len(fullData) - numTrain

# print(numTrain, numTest)

trainData = fullData.iloc[:numTrain]
testData = fullData.iloc[:numTest]
# print(trainData.shape, testData.shape)


testData = testData.drop(labels="SalePrice", axis=1)


X = trainData[[x for x in trainData.columns]]
X.drop(['SalePrice'],axis=1,inplace=True)
y = trainData["SalePrice"]

# print(len(fullData.columns))
# print(len(trainData.columns))
# print(len(X.columns))
([x for x in trainData.columns] == [x for x in fullData.columns])
#[x for x in X.columns]
#y

model = xgb.XGBRegressor()
model.fit(X, y)

yPredictions = model.predict(testData)
# print(len(yPredictions))
# print(len(testData))


# dataToPredict = fullData.iloc[1460:2919]
dataToPredict = fullData.iloc[1460:2920]
dataToPredict.drop(['SalePrice'],axis=1,inplace=True)

# testHouse = dataToPredict.iloc[0]
# dataToPredictWithNewHouse = dataToPredict.append(testHouse)


X_submission = fullData.iloc[0:1460]


X_submission.drop(['SalePrice'],axis=1,inplace=True)
y_submission = fullData["SalePrice"].iloc[0:1460]


model_submission = xgb.XGBRegressor()
model_submission.fit(X_submission, y_submission)

# model_submission.to_csv("model_submission.csv", index=False)

yPredictions = model_submission.predict(dataToPredict)


# testHouse = dataToPredict.iloc[0]
# print(testHouse)

# testPredictions = model_submission.predict(testHouse)
# print(testHouse)
# print(testPredictions)
# testHouse = pd.DataFrame({, columns=dataToPredict.columns()})

print(yPredictions[-1])

# import mysql.connector

# mydb = mysql.connector.connect(
#   host="localhost",
#   user="root",
#   passwd="",
#   database="thepriceisright"
# )

# mycursor = mydb.cursor()

# mycursor.execute("SELECT * FROM housedata")

# myresult = mycursor.fetchall()


# for x in myresult:
# #   print(x)
#   for i in range(len(x)):
#       if(x[i] != None):
#           print(x[i])
#         #   testHouse.at[0, cols[i]] =  x[i]
#           testHouse[i] = x[i]
      
# print(testHouse)


# testHouse = fullData.iloc[1460]
# testPrediction = model_submission.predict(testHouse);

# print(testPrediction)



# yPredictions.to_csv("predictions.csv", index=False)

# output = pd.DataFrame({'Id': range(1461, 2920),
#                        'SalePrice': yPredictions})
# output.to_csv('prediction.csv', index=False)
# print(output)

# pricePrediction = model_submission.predict() 