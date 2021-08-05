# Laravel-upload-file-to-s3-with-serverless-Lambda-

a program that provides an HTTP API to store and retrieve files. It has the following features:</br></br>
- Upload a new file 
- Retrieve an uploaded file by name.</br>
- Delete an uploaded file by name.</br>
- The code can be deployed to the lambda function in AWS </br>
- uploaded files stored in the S3 bucket.</br>
- Use the Amazon API Gateway for the APIs.</br>
- multiple files have similar contents, reuse the contents.

## Setting up


### Requirements
- [PHP >= 7.4](http://php.net/)
- [Composer](https://getcomposer.org/)
- [Xampp](https://www.apachefriends.org/)
- [Git](https://git-scm.com/)


### Clone GitHub repo for this project locally

`git clone https://github.com/baselrabia/Laravel-upload-file-to-s3-with-serverless-Lambda.git`

- `cd Laravel-upload-file-to-s3-with-serverless-Lambda`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`

- last step edit this two fields in your `.env` file the values with your own 

```php
AWS_ACCESS_KEY_ID=***********************************************
AWS_SECRET_ACCESS_KEY=***********************************************
```

## starting the application 

now everthing is almost done just one step more to start your App
-  Run this command line forserveing the App to your localhost ->  `php artisan serve` 

or you can serve it from the deployed lambda on this link => 
https://go3qi1sam9.execute-api.us-east-2.amazonaws.com/
##
# About the tasks

### Uploade File 

at the first when enter in the app will find a form for uploading file to the aws s3 </br>
by submitting the file , its exists in our files now , if you try to uploade it agian will find an error appears said your file exists before 

### List s3 files 

there are another tab called images it should list the files in the aws s3

### find & download file 

in the nav bar you will find the find & download tab will redirect you to a search form you write the name of the file you wanna search about 
if it's exists the app will download the file for you , if not will see an error msg that file is not exists 

### delete file

in the nav bar you will find the Delete tab will redirect you to a Delete form you write the name of the file you wanna Delete
if it's exists the app will Delete the file for you , if not will see an error msg that file is not exists 


# Edition on Lambda deploy 
you can change the code as you want it to behave and when you wanna deploy it,</br>
just use this commands and it will handle it   </br> 
- `npm install -g serverless` </br> 
- `serverless deploy`</br>


