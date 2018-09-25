<template>

 
<div class="modal fade" id="editModal">

<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" @click="clearModal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
<h4 class="modal-title">Update  Record</h4>
</div>

<div class="modal-body">

<p class="alert alert-success" v-if = "success.length > 0 ">{{ success }}</p>
<label for="name">Name</label>
<textarea class="form-control" name="name" id="name" v-model="rec.name"> 

</textarea>


</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" @click="clearModal" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" @click="updateRecord">Update</button>
</div>
</div>

</div>

</div>

 


</template>

<script type="text/javascript">
 
    export default {
        
        props:['rec' ],
        data(){
        return {
           success:'',
           error:[],
           record:'',
        }
        }
        ,

        methods:{
         
           updateRecord(){
               
            axios.post("http://localhost:8000/tasks/"+this.rec.id,{
            'name': this.rec.name,
            '_method': 'PUT'
            })
            .then(data => {
             this.$emit('recordupdated',data);
             this.success = "Task Update Successfully!!!";
              
            })
            .catch(error=> this.error = error.response.data.errors)
           
            },

            clearModal(){
                this.error = [];
                this.success = '';
            }


        }
       
    }
</script>

<style type="text/css" scoped></tyle>