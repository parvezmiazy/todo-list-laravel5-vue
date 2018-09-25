<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h2>Panel Heading</h2></div>

                    <div class="panel-body">
                        Hello, {{ name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(' Sample Component mounted.')
        },

        data(){

            return {
                name:"Parvez Ahmed"
            }
        }
    }
</script> 
<style type="text/css" scoped>
h2{
    color:green
}
</style>
