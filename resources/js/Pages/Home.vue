<template>
  <layout>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <inertia-head title="Home" />
    <div class="container">
      <div class="todo">
        <div class="add-todo">
          <input type="text" v-model="todoItem.name" name="todo" id="todo" />
          <button v-on:click="addTodo">
            <md-icon class="fa fa-plus"></md-icon>
          </button>
        </div>
        <div class="todolist">
          <ul>
            <li v-for="todo in todos" :key="todo.name">
              <span class="md-list-item-text">{{ todo.name }}</span>
              <md-checkbox
                v-on:change="doneOrUndoneTodo(todo.id, todo.done)"
                type="checkbox"
                v-model="todo.done"
              />
            </li>
          </ul>
        </div>
      </div>
    </div>
  </layout>
</template>

<script>
import axios from "axios";
import {
  getAll,
  addTodo,
  doneOrUndoneTodo,
} from "../Services/todoServices/todoServices";
import Layout from "../Layout.vue";

export default {
  data() {
    return {
      token: "",
      user_id: "",
      todoItem: {
        name: "",
        done: true,
      },
      todos: [],
    };
  },
  components: {
    Layout,
  },
  methods: {
    addTodo: async function () {
      if (this.todoItem.name) {
        this.todos.push({
          name: this.todoItem.name,
          done: false,
        });
        await addTodo({
          todoName: this.todoItem.name,
          todoUser: this.user_id,
          token: this.token,
        });
      }
    },
    doneOrUndoneTodo: async function (id, value) {
      console.log(id, value);
      await doneOrUndoneTodo({
        todoId: id,
        todoValue: value,
        token: this.token,
      });
    },
  },
  async mounted() {
    const token = window.localStorage.getItem("user_token");
    const user_id = window.localStorage.getItem("user_id");

    this.token = token;
    this.user_id = user_id;
    if (!token) {
      this.$inertia.get("/login");
    }

    const response = await getAll({
      token,
      user_id,
    });

    this.todos = response.todos;
  },
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
}

.todo {
  width: 450px;
  height: 600px;
  margin-top: 32px;
  display: block;
}

.add-todo {
  min-width: 100%;
  min-height: 60px;
  display: flex;
  align-items: center;
}

.add-todo input {
  width: 80%;
  padding: 8px;
  border-radius: 5px;
}

.add-todo button {
  width: 15%;
  height: 35px;
}

.todolist {
  margin-top: 16px;
}

.todolist ul {
  list-style-type: none;
  padding: 0;
}

.todolist li {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-bottom: 8px;
}

.todolist li .md-checkbox {
  margin-right: 23px;
}
</style>
