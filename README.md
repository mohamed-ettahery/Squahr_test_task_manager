`

# Laravel Vue Task Manager

Laravel Vue Task Manager is a full-stack web application for managing tasks, built with Laravel and Vue.js.

## Features

-   CRUD Operations: Create, Read, Update, and Delete tasks.
-   Sorting and Filtering: Sort tasks by due date and filter by status.
-   Authentication: User authentication system to ensure secure access to the application.
-   Inline Editing: Edit task details inline and update tasks seamlessly.
-   Client-Side Routing: Navigate between different views using Vue Router.
-   Form Validation: Ensure valid data entry with frontend form validation.

## Bonus Features

-   User Registration and Login: Allow users to register accounts and log in securely.
-   User-Specific Functionality: Users can see and edit only their tasks.
-   Drag-and-Drop: Implement drag-and-drop functionality to reorder tasks.
-   Pagination: Paginate task lists for better organization.

## Screenshots

![Login screen](screens/login_screen.png)
_Login screen_

![Register screen](screens/register_screen.png)
_Register screen_

![home screen](screens/home_screen.png)
_home screen_

![add screen](screens/add_screen.png)
_add screen_

![edit screen](screens/edit_screen.png)
_edit screen_

![delete screen](screens/delete_screen.png)
_delete screen_

![filter screen](screens/filter_screen.png)
_filter screen_

![sort screen](screens/sort_screen.png)
_sort screen_

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
