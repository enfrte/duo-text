# Instructions

## Step 1.

Upload 2 translated text files (.txt). The script will combine them into a single tab separated file, which can be opened in a spreadsheet app. What you end up seeing in the spreadsheet is each word in an individual row with the first word of the learning text in the A1 cell and the first word in the known language in A2, and so on. It helps to add a column in between and then copy paste the text from the third column to the second to correctly match the word in the first column. After some manual editing, you should be left with two columns of left to right translations of each word.


Once you are done with step 1, save the file as a tab separated text doc and proceed to step 2.


[Click here](http://codinginthecold.byethost5.com/demos/duo-text/step1.html) to execute step 1.


## Step 2.

Once you are done with step 1, upload the saved spreadsheet file. It will be converted into a json formated text. Save the file --it should be called finshed.json


[Click here](http://codinginthecold.byethost5.com/demos/duo-text/step2.html) to execute step 2.


## Step 3.

Download [this page](https://raw.githubusercontent.com/enfrte/duo-text/master/duo-text/index.html) and [this file](https://raw.githubusercontent.com/enfrte/duo-text/master/js/alpine.min.js) to it's own location on your server and add the finished.json file to the same location. When you access index.html, it should display the text like this...

![image](https://user-images.githubusercontent.com/5081917/150653360-7063dda8-354a-4f68-ba8d-0a3e816ff71a.png)

