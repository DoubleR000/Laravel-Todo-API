# Laravel Todo API

A simple CRUD API for Todo apps. Made for practicing purposes only.

The API has authentication and authorization features, making sure that users can only view and modify Todos if they are logged in and if they own them.



## Routes:
### Auth
`/api/register` (POST) - registers a new user and issues an API token. Needs JSON input.

Sample register input:
```
{
    "email": "sample@email.com",
    "name": "John Doe",
    "password": "password",
    "password_confirmation": "password"
}
```

`/api/login` (POST) - issues the user an API token. Needs JSON input.

```
{
    "email": "sample@email.com",
    "password": "password"
}
```

`/api/logout` (POST) - deletes all API tokens of the authenticated user.  

### Todos
`/api/todos` (GET) - gets a list of the user's Todos.  
`/api/todos` (POST) - creates a new Todo. Needs JSON input.  
`/api/todos/{todo-id}` (GET) - gets the specific Todo.  
`/api/todos/{todo-id}` (PUT) - updates the Todo's contents. Needs JSON input.  
`/api/todos/{todo-id}` (DELETE) - deletes the Todo.  

Sample Todo input:
```
{
    "title" : "Sample title",
    "content" : "Sample content"
}
```
