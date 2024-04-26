<template>
  <div class="home">
    <nav class="navbar bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand">SquaHr</a>
        <div class="d-flex align-center justify-content-around">
          <div class="profile mx-5">
            <img src="https://avatar.iran.liara.run/public/boy" class="mx-2" width="40" alt="">
            <span>{{ user }}</span>
          </div>
          <button class="btn btn-outline-primary" @click="logout">&#x21b5; Logout</button>
        </div>
      </div>
    </nav>
    <div class="content">
      <div class="table-section">
        <div class="head-actions my-4 d-flex justify-content-between align-items-center">
          <div class="filter-group">
            <label>Filter By : </label>
            <select class="form-select" @change="filterBy($event.target.value)" id="status">
              <option value="all">All</option>
              <option value="in_progress">In Progress</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div class="sort-group">
            <label>Sort By : </label>
            <select class="form-select" @change="sortBy($event.target.value)">
              <option value="default">Default</option>
              <option value="due_date">Due date</option>
              <option value="status">Status</option>
            </select>
          </div>
          <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addModal">&#x2b; Add new
            task</button>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Due Date</th>
              <th scope="col">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasks" :key="task.id">
              <th scope="row">{{ task.id }}</th>
              <td>{{ task.title }}</td>
              <td> {{ task.description }}</td>
              <td>{{ task.due_date }}</td>
              <td><span
                  :class="['badge', 'rounded-pill', 'text-bg-' + (task.status === 'in_progress' ? 'warning' : 'success')]">{{
              task.status === 'in_progress' ? 'In Progress' : task.status }}</span>
              </td>
              <td>
                <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#editModal"
                  @click="getTask(task.id)">&#9998; Edit</button>
                <button class="btn btn-outline-danger" @click="deleteProduct(task.id)">&#10008; Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!--Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addModalLabel">Edit Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container mt-5">
              <form>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" v-model="task.title" id="title"
                    placeholder="Enter task title">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" v-model="task.description" id="description" rows="3"
                    placeholder="Enter task description"></textarea>
                </div>
                <div class="form-group">
                  <label for="dueDate">Due Date</label>
                  <input type="date" v-model="task.due_date" class="form-control" id="dueDate">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" v-model="task.status" id="status">
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                  </select>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updateTask(task.id)">Save</button>
          </div>

        </div>
      </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addModalLabel">Add New Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container mt-5">
              <form>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" v-model="task.title" id="title"
                    placeholder="Enter task title">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" v-model="task.description" id="description" rows="3"
                    placeholder="Enter task description"></textarea>
                </div>
                <div class="form-group">
                  <label for="dueDate">Due Date</label>
                  <input type="date" v-model="task.due_date" class="form-control" id="dueDate">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" v-model="task.status" id="status">
                    <option value="in_progress">in_progress</option>
                    <option value="completed">Completed</option>
                  </select>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="addTask()">Add</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'HomeView',
  data() {
    return {
      user: localStorage.getItem("user"),
      token: localStorage.getItem("token"),
      tasks: "",
      task: { title: "", description: "", due_date: "", status: "in_progress" }
    }
  },
  methods: {
    getTasks() {
      if (!this.token) {
        console.error("No token found. Unable to fetch tasks.");
        return; // Stop execution if token is not found
      }

      axios.get('api/tasks', {
        headers: {
          'Authorization': `Bearer ${this.token}` // Set token in Authorization header
        }
      })
        .then(res => {
          this.tasks = res.data;
          // console.log(res.data)
        })
        .catch(error => {
          console.error("An error occurred while fetching tasks:", error);
        });
    },
    logout() {
      Swal.fire({
        title: 'Are you sure you want to logout?',
        text: 'You will be logged out of the system.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // If the user confirms, perform logout
          localStorage.removeItem("user");
          localStorage.removeItem("token");
          this.$router.push('/login');
        }
      });
    }
    ,
    filterBy(status) {
      axios.post('api/tasks/filter', { filterBy: status }, {
        headers: {
          'Authorization': `Bearer ${this.token}` // Set token in Authorization header
        }
      })
        .then(res => {
          this.tasks = res.data;
          // console.log(res.data)
        })
        .catch(error => {
          console.error("An error occurred while fetching tasks:", error);
        });
    },
    sortBy(sortBy) {
      axios.post('api/tasks/sort', { sortBy }, {
        headers: {
          'Authorization': `Bearer ${this.token}` // Set token in Authorization header
        }
      })
        .then(res => {
          this.tasks = res.data;
          // console.log(res.data)
        })
        .catch(error => {
          console.error("An error occurred while fetching tasks:", error);
        });
    },
    addTask() {
      // Check if any field is empty
      if (!this.task.title || !this.task.description || !this.task.due_date || !this.task.status) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Please fill in all fields!',
        });
        return;
      }

      // Check if due_date is a future date
      const today = new Date();
      const dueDate = new Date(this.task.due_date);
      // If due_date is not a future date, show Swal error
      if (dueDate <= today) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Due date must be a future date!',
        });
        return;
      }

      // All checks passed, proceed with axios request
      axios.post('api/tasks/', {
        title: this.task.title,
        description: this.task.description,
        due_date: this.task.due_date,
        status: this.task.status
      }, {
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      })
        .then(res => {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'New Task has been added successfully!',
            showConfirmButton: false,
            timer: 1500,
          });
          this.getTasks();
          console.log(res.data);
        })
        .catch(error => {
          console.error('An error occurred while fetching tasks:', error);
        });
    }
    ,
    deleteProduct(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("/api/tasks/" + id,
              {
                headers: {
                  'Authorization': `Bearer ${this.token}` // Set token in Authorization header
                }
              })
            .then((res) => {
              Swal.fire(
                "Deleted!",
                "product has been deleted.",
                "success"
              );
              this.getTasks();
            })
            .catch((err) => console.log(err));
        }
      });
    },
    getTask(id) {
      axios.get('api/tasks/' + id, {
        headers: {
          'Authorization': `Bearer ${this.token}`
        }
      })
        .then(res => {
          this.task = res.data;
          console.log(res.data)
        })
        .catch(error => {
          console.error("An error occurred while fetching tasks:", error);
        });
    },
    updateTask(id) {
      axios.put('api/tasks/' + id,
        {
          title: this.task.title,
          description: this.task.description,
          due_date: this.task.due_date,
          status: this.task.status
        },
        {
          headers: {
            'Authorization': `Bearer ${this.token}`
          }
        })
        .then(res => {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Task has been updated succesfully!",
            showConfirmButton: false,
            timer: 1500,
          });
          console.log(res.data)
          this.getTasks();
        })
        .catch(error => {
          console.error("An error occurred while fetching tasks:", error);
        });
    }
  },
  mounted() {
    this.getTasks();
  }
}
</script>
<style scoped>
.table-section {
  margin: 50px auto;
  width: 80%;
  padding: 30px;
  border-radius: 10px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}
</style>