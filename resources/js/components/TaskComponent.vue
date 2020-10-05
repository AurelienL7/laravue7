<template>
    <div class="container">
        <add-task @task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary my-3" data-toggle="modal" data-target="#editModal" @click="getTask(task.id)">
                Edit task
                </button>
            </li>
            <edit-task v-bind:taskToEdit="taskToEdit"></edit-task>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                tasks: {},
                taskToEdit: ''
            }
        },

        created(){
            axios.get('http://127.0.0.1:8000/tasksList')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },

            getTask(id){
                 axios.get('http://127.0.0.1:8000/tasks/edit/' + id)
                    .then(response => this.taskToEdit = response.data.name)
                    .catch(error => console.log(error));
            },

            refresh(tasks){
                this.tasks = tasks.data
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
