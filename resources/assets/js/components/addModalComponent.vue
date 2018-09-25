<template>

 
<div class="modal fade" id="addModal">

<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" @click="clearModal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
<h4 class="modal-title">Add New Record</h4>
</div>

<div class="modal-body">
<p class="alert alert-success" v-if = "success.length > 0 ">{{ success }}</p>

<label for="name">Name</label>
<textarea class="form-control" name="name" id="name" v-model="record"> 

</textarea>

<ul  v-if ="error.name" class="list-unstyled">
<li v-for="err of error.name" class="alert alert-danger">{{err}}</li>
</ul>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" @click="clearModal" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" @click="addRecord">Add</button>
</div>
</div>

</div>

</div>

 


</template>

<script type="text/javascript">
 
    export default {
        
        data(){
        return {
           success:'',
           error:[],
           record:'',
        }
        }
        ,

        methods:{
         
            addRecord(){
               
            axios.post("http://localhost:8000/tasks",{
            'name':this.record,
            })
            .then(data => {
             this.$emit('recordadded',data);
             this.success = "Task Added Successfully!!!";
              this.record = '';
            })
            .catch(error=> this.error = error.response.data.errors)
           
            },

            clearModal(){
                this.error = [];
                this.record = '';
                this.success = '';
            }


        }
       
    }
</script>

<style type="text/css" scoped></tyle>