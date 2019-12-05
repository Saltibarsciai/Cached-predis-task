<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Items</div>
                    <div class="card-body">
                        <form action="" class="form-group">
                            <input type="text" placeholder="Provide task name" v-model="name" class="form-control"/>
                            <input @click.prevent="formSubmit(buttonText)" type="submit" :value="buttonText" class="btn btn-primary mt-2"/>
                        </form>
                        <hr>
                        <ul class="list-group">
                            <li v-for="item in items" class="list-group-item">
                                <h3>
                                    {{item.name}}
                                </h3>
                                <button @click="updateItem(item)" class="btn btn-info">
                                    update
                                </button>
                                <button @click="deleteItem(item.id)" class="btn btn-danger">
                                    delete
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Master",
        mounted() {
            console.log('Component mounted.');
            this.getData();
        },
        data() {
            return {
                items: {},
                buttonText: 'store',
                name: '',
                id: 1
            }
        },
        methods: {
            getData(){
                axios.get('/api/tasks').then(res => {
                    this.items = res.data
                }).catch(e => {
                    alert(e)
                })
            },

            updateItem(item) {
                this.name = item.name;
                this.id = item.id;
                this.buttonText = 'update';
            },
            formSubmit(type){
                switch (type) {
                    case 'store':
                        axios.post('/api/tasks', {name: this.name}).then(res => {
                            console.log(res.data);
                            this.getData()
                        }).catch(e => {
                            alert(e)
                        });
                        break;
                    case 'update':
                        axios.patch('/api/tasks/'+this.id, {name: this.name}).then(res => {
                            this.buttonText = 'store';
                            this.getData()
                        }).catch(e => {
                            alert(e)
                        });
                        break;
                    default:
                        alert('error formSubmit');
                        break;
                }
                this.name = '';
            }

        }
    }
</script>

<style scoped>

</style>
