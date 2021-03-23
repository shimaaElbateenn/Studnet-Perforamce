import sys
import pandas as pd
import numpy as np
import sklearn
import matplotlib.pyplot as pyplot
import pickle
from matplotlib import style
from flask import Flask, request, jsonify
import traceback
import joblib
from sklearn import linear_model
from sklearn import model_selection
from pandas import DataFrame
import json
import requests


app = Flask(__name__)

#url = 'http://127.0.0.1:12345/'

data = pd.read_csv("student-mat.csv", sep=";")

data = data[["G1", "G2", "G3", "studytime", "failures", "absences"]]

predict = "G3"

x = np.array(data.drop([predict], 1))
y = np.array(data[predict])
x_train, x_test, y_train, y_test = sklearn.model_selection.train_test_split(x, y, test_size=0.1)

best = 0
for _ in range(30):
    x_train, x_test, y_train, y_test = sklearn.model_selection.train_test_split(x, y, test_size=0.1)

    linear = linear_model.LinearRegression()

    linear.fit(x_train, y_train)
    acc = linear.score(x_test, y_test)
    print("acc", acc)

    if acc > best:
        best = acc
        with open("studentmodel.pickel", "wb") as f:
            pickle.dump(linear, f)

pickle_in = open("studentmodel.pickel", "rb")
linear = pickle.load(pickle_in)

@app.route('/', methods=['POST', 'GET'])
def predict():
    if linear:
        try:
            return jsonify({'data': result.tolist()})
        except:
            return jsonify({'trace ': traceback.format_exc()})
    else:
        print('Train the model first')
        return ('No model here to use')

alist = []
prediction = linear.predict(x_test)
for x in range(len(prediction)):
    print(prediction[x], x_test[x], y_test[x])
    temp = list(x_test[x])
    temp.append(y_test[x])
    temp.append(round(prediction[x], 2))
    alist.append(temp)
result = np.array(alist)

p = "studytime"
style.use("ggplot")
pyplot.scatter(data[p], data["G3"])
pyplot.xlabel(p)
pyplot.ylabel("Final Grade")
pyplot.show()

if __name__ == '__main__':
    try:
        port = int(sys.argv[1])  # This is for a command-line input
    except:
        port = 12346  # If you don't provide any port the port will be set to 12345
    app.run(debug=True, port=port)
