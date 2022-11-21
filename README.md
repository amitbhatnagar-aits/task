# task
Task Management With Multiple Notes REST APIs

This project consists of following REST APIs:


Register REST API- Type :	POST,	Auth Not Required

Login REST API- Type : POST,	Auth Not Required

Add Tasks REST API - Type: POST,	Token Required (Received After Successful login)

View Tasks REST API	- Type: GET, Token Required (Received After Successful login)


Note : To test these APIs please install the POSTMAN if you don’t have it already. Link to download the POSTMAN is https://www.postman.com/downloads/

After you have successfully downloaded the POSTMAN let us move forward to download the project. You can easily download it from my public github repository here:
https://github.com/amitbhatnagar-aits/task/


Once you have downloaded the Project simply create any folder inside your system’s local server environment (htdocs,inetpub etc). Folder’s name can be anything. In my case I have named the folder as tasks.

Copy the project in the folder and run install.php file this will install the database and it’s tables immediately.

Once database and it’s tables are created we are all set to test the APIs.

Let’s start one by one :
 
Register API :

To run the Register API simply run the register.php file in POSTMAN. You don’t need any authentication token for this request. This is POST request. Navigate to BODY in POSTMAN and select JSON from the dropdown list.
Then simply enter the json data with your desired username and password. Finally click on SEND button. 

If all the steps followed properly then you should get the success response.

For more details please refer to the image below.

![image](https://user-images.githubusercontent.com/76569389/202933703-7867f7df-5a9a-4c79-9570-317bfc74b399.png)


 

Login API :

To run the Login API simply run the login.php file in POSTMAN. You don’t need any authentication token for this request. This is POST request. Navigate to BODY in POSTMAN and select JSON from the dropdown list.
Then simply enter the json data with your registered username and password. Finally click on SEND button. 

If you enter correct login credentials then you should get the authentication token in response. You need to use that token for every other API so save it.
For more details please refer to the image below.

![image](https://user-images.githubusercontent.com/76569389/202933732-3c705add-e216-4a7e-8d6f-d85e2b722a66.png)

 
Add Task API :

To run the Add Task API simply run the add_task.php file in POSTMAN. You will need thr authentication token for this request. Token that you just received after successful login. 

To add the token simply Navigate to Headers in POSTMAN and add your token. In the Key Name add Authorization and in Value add your token, don’t forget to add Bearer word before adding your token in the value otherwise token will not work. Refer to image below for better understanding :

![image](https://user-images.githubusercontent.com/76569389/202933758-5acb58ac-3a97-43f2-8aa8-0f9e5e44856b.png)

 

After you have successfully updated the token in Headers then simply Navigate to BODY in POSTMAN and select JSON from the dropdown list.
Then simply enter the json data to add tasks with multiple notes. Sample data format is as follows :

![image](https://user-images.githubusercontent.com/76569389/202933800-2f4f2cf4-fafe-4df8-8c2c-20b1f2d7e5f2.png)

 

Sample Data JSON :
{"subject":"task subject","description":"task description","notes":[["note subject","file1.jpg,file2.pdf,file3.docx", "this is sample note description"],["demo note subject ","file4.jpg,file5.pdf,file6.docx", "2 this is sample note description"]],"start_date":"2022-11-18","due_date":"2022-11-21","status":"New","priority":"High"}

Finally click on SEND button. 

If you enter JSON data correctly then you should get the success message and your Task with Multiple Notes in a single request will be stored in the database through this REST API. For more details please refer to the image below.

![image](https://user-images.githubusercontent.com/76569389/202933813-444b0fb4-156c-4ec8-8df8-f69bbfa49742.png)

 
View Task API :

To run the View Task API simply run the fetch-tasks.php file in POSTMAN. You will need the authentication token for this request. Token that you just received after successful login. 

To add the token simply Navigate to Headers in POSTMAN and add your token. In the Key Name add Authorization and in Value add your token, don’t forget to add Bearer word before adding your token in the value otherwise token will not work. Refer to image below for better understanding :

![image](https://user-images.githubusercontent.com/76569389/202933827-2085ee49-f7b3-409f-816b-9ace84492036.png)

 
Finally click on SEND button. If token is valid you will get the response in JSON format.

Filters in this Requests :

There are multiple filters integrated with the API they are as follows :
filter[status], filter[due_date], filter[priority], filter[notes]: Retrieve tasks which have minimum one note attached
To make use of any or all the filters together simply add the PARAMETERS in the POSTMAN. To add parameters simply navigate to Params and start adding the parameters. For better understanding see the image below :

 ![image](https://user-images.githubusercontent.com/76569389/202933842-e68c22eb-054b-4080-b993-57b7990fe900.png)

 

These filters can work individually as well as combined.


For any further Queries feel free to contact me at : amitattitude2010@gmail.com


Sample Username to Login : 

{"username":"amit","password":"amit"}

Pass this in by Selecting JSON in POSTMAN.


Thank You For Your Time.
