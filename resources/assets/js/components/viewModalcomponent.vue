<template>

 
<div class="modal fade" id="viewModal">

<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
<h4 class="modal-title">View  Single Task</h4>
</div>

<div class="modal-body">

<label for="view">View Task</label>
<p>{{ viewRec.name }}</p>



</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>

</div>
</div>

</div>

</div>

 


</template>

<script type="text/javascript">
 
    export default {
        
        props:['viewRec']
        
       
    }
</script>

 