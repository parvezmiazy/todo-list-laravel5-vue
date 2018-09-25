<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">

 
                    <div class="panel-heading"><h4>All Tasks List <span class="pull-right">
<a class="btn btn-primary btn-xs" data-toggle="modal" href="#addModal">+</a>
                    </span></h4></div>

                    <div class="panel-body">
                    <input class="form-control" type="search" v-model="search" @keyup="searchRecord" placeholder="Type Your Key Word"/>
                      <br/>
                      <ul class="list-group">
                      <li class="list-group-item" v-for="t in tasks.data">{{t.id}}-{{t.name}} 
                      <span class="pull-right">
                      <a class="btn btn-primary btn-xs" @click="getRecord(t.id)" data-toggle="modal" href="#editModal">Edit</a>
                      |<a @click="delRecord(t.id)" class="btn btn-danger btn-xs">Delete</a>
                      <a class="btn btn-info btn-xs" @click="getRecord(t.id)" data-toggle="modal" href="#viewModal" >Preview</a></span></li>
                      </ul>
                      <pagination :data="tasks" @pagination-change-page="getResults"></pagination>
                       <div class="panel-footer text-right"><small>copyright &copy; 2018 Parvez Ahmed</small></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal">
        <addtask @recordadded="refreshRecord"></addtask>
        <edittask :rec="editRec" @recordupdated="refreshRecord"></edittask>
        <viewtask :viewRec="editRec"></viewtask>
        </div>
    </div>
</template>

<script type="text/javascript">
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('addtask',require('./addModalComponent'));
Vue.component('edittask',require('./editModalComponent'));
Vue.component('viewtask',require('./viewModalComponent'));
 
    export default {
        
        data(){
            return{
                tasks:{},
                editRec:{},
                records:{},
                errors:[],
                search:'' 
                
            }
        },

        methods:{

            // Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
			axios.get('http://localhost:8000/tasks?page=' + page)
				.then(response => {
					this.tasks = response.data;
				});
		},

        refreshRecord(record){

        this.tasks = record.data

        },

        getRecord(id){
           
                axios.get('http://localhost:8000/tasks/'+id+'/edit')
                .then(response => this.editRec= response.data)
                .catch(error => this.errors = error.response.data.errors)
                

        },

        delRecord(id){  
            const reply = confirm("Are You Sure? You Want To Delete This Record?");
            if(reply)
            {
                  axios.post('http://localhost:8000/tasks/'+id,{
                  id:id,
                  _method:'DELETE'
                 })
                .then( response => this.refreshRecord(response))
                .catch( error => console.log(error.response.data.errors))
            }
            else
             {
                return
                
             }

          

        },

        searchRecord(){

            if(this.search.length >=3){

                  axios.get('http://localhost:8000/tasks/search/'+this.search)
                  .then((response)=>this.tasks = response.data)
                  .catch((error)=>console.log(error));
            } 

            else{
                this.getResults();
            }
        }

        },
        created(){
            axios.get('http://localhost:8000/tasks/')
            .then((response)=>this.tasks = response.data)
            .catch((error)=>console.log(error));
              console.log('Tasks Component mounted.');
        }
    }
</script>