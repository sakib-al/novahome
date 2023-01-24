<template>
    <div>
        <form action="javascript:void(0)" method="POST" >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Section Name*</b></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Design Type *</b></label>
                        <select class="form-control" required>

                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted example.')
        }
    }
</script>
