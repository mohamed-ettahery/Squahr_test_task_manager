`
# Laravel Vue Task Manager

Laravel Vue Task Manager is a full-stack web application for managing tasks, built with Laravel and Vue.js.

## Features

- CRUD Operations: Create, Read, Update, and Delete tasks.
- Sorting and Filtering: Sort tasks by due date and filter by status.
- Authentication: User authentication system to ensure secure access to the application.
- Inline Editing: Edit task details inline and update tasks seamlessly.
- Client-Side Routing: Navigate between different views using Vue Router.
- Form Validation: Ensure valid data entry with frontend form validation.

## Bonus Features

- User Registration and Login: Allow users to register accounts and log in securely.
- User-Specific Functionality: Users can see and edit only their tasks.
- Drag-and-Drop: Implement drag-and-drop functionality to reorder tasks.
- Pagination: Paginate task lists for better organization.

## Screenshots

![Login screen](/assets/login_screen.png)
*Login screen*

![Register screen](/assets/register_screen.png)
*Register screen*

![home screen](/assets/home_screen.png)
*home screen*

![add screen](/assets/add_screen.png)
*add screen*

![edit screen](/assets/edit_screen.png)
*edit screen*

![delete screen](/assets/delete_screen.png)
*delete screen*

![filter screen](/assets/filter_screen.png)
*filter screen*

![sort screen](/assets/sort_screen.png)
*sort screen*


# Clone the repository

```bash
git clone https://github.com/mohamed-ettahery/Squahr_test_tasks_management.git
```
# Install dependencies

```bash
composer install
npm install
```
# Run migrations

 ```bash
php artisan migrate
 ```

# Build Vue.js assets

 ```bash
npm run dev
 ```
# Start the development server

 ```bash
php artisan serve
 ```