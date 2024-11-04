# lumen_api
lumen_api for task management

# Clone the project using the command
 https://github.com/kipkuruibarnaba/lumen_api.git


# Run the below composer command
   Composer update
# Create the database below in postgress
    task-db
# Run migration with the command
    php artisan make:migration create_tasks_table
# Run the migration command to create tables in the database
    php artisan migrate
# Start the application with the below command
    php -S localhost:8000 -t public

# your application should now be accesible via the url 
    http://localhost:8000/    

# Create the the below API collection
     
     TYPE 
     ==========================================================================================================
      METHOD TYPE     URL                                        NAME                       DESCRIPTION
      =========================================================================================================
        GET           http://localhost:8000/tasks               getAllTasks                For getting all tasks
                                                                                                   
        GET           http://localhost:8000/tasks/1             getTaskById                For getting a by id
                                                                                                   task  
        
        GET           http://localhost:8000/tasks/findbytitle   getTaskByTitle             For getting a task  
                                                                                            by title  
    
        GET           http://localhost:8000/tasks/filterstatdate   filterByStatusDueDate    For filtering tasks 
                                                                                            by status and due date title    

        POST           http://localhost:8000/tasks                createTask                For Creating a task 
                                                                                                                                                        PUT           http://localhost:8000/tasks/1               updateTask                For Updating a task 
                                                                                                                                                        DEL           http://localhost:8000/tasks/1               deleteTask                For Deleting a  task
                                                                                                                                                                                                                                            
       ========================
                
