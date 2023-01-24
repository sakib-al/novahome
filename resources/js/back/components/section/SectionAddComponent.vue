<template>
    <div>
        <form action="javascript:void(0)" method="POST" ref="section_add_form" @submit="sectionSubmit()">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Section Name*</b></label>
                                <input type="text" name="title" class="form-control" placeholder="write section here" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Display section title *</b></label>
                                <select class="form-control" name="title_is_show" required>
                                    <option :value="true">Yes</option>
                                    <option :value="false">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Design Type *</b></label>
                                <select class="form-control" v-model="design_type" name="section_design_type_id" required>
                                    <option value="null">Select One</option>
                                    <option v-for="(type,key) in section_design_types" :value="type.id" :key="key">{{ type.name }}</option>
                                </select>
                            </div>
                        </div>
                        <template v-if="design_type===2 || design_type === 3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Number of Column *</b></label>
                                    <select class="form-control" name="col" required>
                                        <option value="3">3</option>
                                        <option value="4">4</option>>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Number of row *</b></label>
                                    <input type="number" name="row" class="form-control" placeholder="write number of row here" required>
                                </div>
                            </div>
                        </template>

                    </div>
            </div>
            <div class="modal-footer">2
                <button type="button" class="btn btn-secondary" @click="modalClose" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import Vue from 'vue'
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
import axios from "axios";
export default {
    props:{
        section_design_types:{
            type:Array,
            required:true,
        }
    },
    data(){
      return{
          design_type:null,
      }
    },
    methods:{
        async sectionSubmit(){
            let data =new FormData(this.$refs.section_add_form);
            await axios.post('/adminx/frontend/section/type/store',data).then((response)=>{
                this.$refs.section_add_form.reset();
                if (response.data.status ==='success') this.$toaster.success(response.data.message);
                else this.$toaster.error(response.data.message);
            }).catch(()=>{
                this.$toaster.error('Invalid request');
            })
        },
        modalClose(){
            window.location.reload();
        }
    }
}
</script>
