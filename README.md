# Todo
 Todo is tasks management :

 It Has 2 main projects:
    - API which contains all the Api of the application
    - Front end
    - Test.pdf file which contains the remaining exersices.
    -todo.sql (database)

Developed using PHP, JS, Jquery, Bootstrap and Lumen for the APIs.
Upload it on any server Xampp, wamp, Mamp ...
Import database todo.sql into your phpmyadmin
Access Todo/API/.env and change the database connection

To run the application open localhost/Todo : a login page must appear / username: user | password: password.

Make sure that the port is 80. If not,make sure to include it in url (localhost:8888/todo)

Access the API folder in the terminal and run it using (php artisan serve)

APIs:

- Authenticate and get the token: http://localhost:8000/api/Authenticate :

Request:
    - Http request type POST
    - Parameters: username, password
Response:
    {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9BdXRoZW50aWNhdGUiLCJpYXQiOjE1OTc3ODk0NTUsImV4cCI6MTU5Nzc5MzA1NSwibmJmIjoxNTk3Nzg5NDU1LCJqdGkiOiJFTlFzRkJ3QkVsOU5Hd3NjIiwic3ViIjozLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.oNE9IMgPSawwG9OCpd2qQ6GM3O81t8f9v1Uyoge32uk",
    "token_type": "bearer",
    "expires_in": null
}

- To Login : http://localhost:8000/api/login :

Request:
    - Http request type GET
    - Header: Authorization Bearer token

Response:
    {
    "id": 3,
    "FirstName": "Miled",
    "LastName": "El Kareh",
    "username": "miled",
    "password": "$2y$10$chQoEvWbidCd.CpHgWVKIeC7LHmDi4vySFlRBJ3YDhCbkA1gx8tQm",
    "Email": "karehmiled@gmail.com",
    "Mobile": "+961 70 941 652",
    "Gender": "Male",
    "Birthday": "2020-08-18",
    "created_at": "2020-08-18T16:25:47.000000Z",
    "updated_at": "2020-08-18T16:25:47.000000Z"
}
    
- To register new user : http://localhost:8000/api/register

Request:
    - Http request type POST
    -Paramters: 
        'username' => $username,
		'password' => $password,
		'Email'=>$email,
		'Gender'=>$gender,
		'Birthday'=>$birthday,
		'FirstName'=>$firstName,
		"LastName"=>$lastName,
		"Mobile"=>$mobile,
		"password_confirmation"=>$password_confirmation
    
Response: 
    {
    "entity": "users",
    "action": "create",
    "result": "success"
    }

- Get all the tasks for the user : http://localhost:8000/api/getTasks?id=1 (the id is the user loged in)

Request:
    - Http request type GET
    - Header: Authorization Bearer token

- Add Task : http://localhost:8000/api/addTask/

Request: 
    - Http request type POST
    -Parameters : 
        'Name' => $Name,
        'Description' => $Description,
        'Dat'=>$Dat,
        'Status'=>$Status,
        'Category'=>$Category,
        'user_id'=>$userid
     - Header: Authorization Bearer token

- Update Task : http://localhost:8000/api/updateTask/

Request: 
    - Http request type POST
    -Parameters : 
        'Name' => $Name,
        'Description' => $Description,
        'Dat'=>$Dat,
        'Status'=>$Status,
        'Category'=>$Category
     - Header: Authorization Bearer token

- Get Tasks by Date : http://localhost:8000/api/getTasksByDate?id=1&date=$date&category=$category&status=$status (the id is the user loged in)

Request: 
    - Http request type GET
    - Header: Authorization Bearer token

- Get Tasks by Month : http://localhost:8000/api/getTasksByDate?id=1&month=$month&year=$year&category=$category&status=$status (the id is the user loged in)

Request: 
    - Http request type GET
    - Header: Authorization Bearer token

- To add a category : http://localhost:8000/api/addCategory/

Request:
     - Http request type POST
     - Parameter: Name
     - Header: Authorization Bearer token

-To Update a category : http://localhost:8000/api/updateCategory/1'

Request:
    - Http request type POST
     - Parameter: Name
     - Header: Authorization Bearer token

-To Delete a category : http://localhost:8000/api/deleteCategory/1'

Request:
    - Http request type POST
    - Header: Authorization Bearer token

