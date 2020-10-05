<template>
    
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">
        Add task
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="">Task Name</label>
                        <textarea name="name" id="name" rows="4" class="form-control" v-model="name"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" @click="storeTask" data-dismiss="modal">Create task</button>
            </div>
            </div>
        </div>
        </div>
    </div>

</template>

<script>
export default {

    data(){
        return{
            name: ''
        }
    },

    methods:{
        storeTask(){
            axios.post('http://127.0.0.1:8000/tasksList', {
                name: this.name
            })
            .then(response => this.$emit('task-added', response))
            this.name = ""
            .catch(error => console.log(error));
        }
    }
}
</script>