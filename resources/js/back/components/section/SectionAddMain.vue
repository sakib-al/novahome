<template>
    <div>
        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" @submit="sectionSubmit()" ref="section_add_form" id="productForm">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
<!--                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><b>Section *</b></label>
                                    <select class="form-control" name="section_name_id" v-model="section_name_id" required>
                                        <option value="null">Select One</option>
                                        <option v-for="(sec,key) in section_names" :value="sec.id" :key="key">{{sec.title}}</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Section Name*</b></label>
                                    <input type="text" name="section_name" class="form-control" placeholder="write section here" required>
                                </div>
                            </div>
<!--                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Background Color *</b></label>
                                    <input type="text" name="background_color" class="form-control colorpicker" placeholder="select an color" required>
                                </div>
                            </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Display section title *</b></label>
                                    <select class="form-control" name="section_name_is_show" required>
                                        <option :value="true">Yes</option>
                                        <option :value="false">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Background color *</b></label>
                                    <input type="color" name="background_color" class="form-control colorpicker" value="#ffffff"  required>
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
                                        <input type="number" name="row" class="form-control" value="1" placeholder="write number of row here" required>
                                    </div>
                                </div>
                            </template>

<!--                            <input type="hidden" class="form-control form-control-sm" name="section_design_type_id" v-model="section_design_id">
                            -->
<!--                            <div class="col-md-4">
                                <div class="form-group">
                                    <i class="fas fa-plus-circle plus_custom" data-toggle="modal" data-target="#section_add_modal"></i>
                                </div>
                            </div>-->
                            <template v-if="!optional_designs.includes(design_type)">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Title *</b></label>
                                        <input type="text" class="form-control form-control-sm" name="title" placeholder="Title write here.." required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Sub Title</b></label>
                                        <input type="text" class="form-control form-control-sm" name="sub_title" placeholder="Sub Title write here..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Image Align</b></label>
                                        <select class="form-control" name="text_align">
                                            <option  value="1">Left</option>
                                            <option  value="2">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Button Name</b></label>
                                        <input type="text" class="form-control form-control-sm" name="button_name" placeholder="button name write here..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Button URL</b></label>
                                        <input type="text" class="form-control form-control-sm" name="button_url" placeholder="button url write here..">
                                    </div>
                                </div>
                                <div class="col-md-4" v-if="design_type === 4">
                                    <div class="form-group">
                                        <label><b>Template</b></label>
                                        <select class="form-control" name="parallax_option">
                                            <option  value="1">Vote</option>
                                            <option  value="2">Opinion</option>
                                        </select>
                                    </div>
                                </div>
                                <template v-if="section_design_id===3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Raised Amount</b></label>
                                            <input type="number" class="form-control form-control-sm" name="raised_amount" step="any" placeholder="raised amount write here..">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Raised Percentage</b></label>
                                            <input type="number" class="form-control form-control-sm" name="raised_percentage" step="any" placeholder="raised percentage write here..">
                                        </div>
                                    </div>
                                </template>
                            </template>

                        </div>
                        <div class="col-md-3" v-if="!optional_designs.includes(design_type)">
                            <div class="col-md-12">
                                <div class="card border-light mt-3 shadow">
                                    <div class="card-body">
                                        <img class="img-thumbnail uploaded_img"  :src="'/img/default-img.png'" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <label><b>Image*</b></label>
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input image_upload" name="image" accept="image/*" required>
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Display Image Inner Border *</b></label>
                                        <select class="form-control" name="is_image_inner_border" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <template v-if="!optional_designs.includes(design_type) && design_type !== 4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Short Description*</b></label>
                            <vue-editor v-model="short_description" name="short_description" ></vue-editor>
<!--                            <textarea id="editor" class="form-control summernote" name="short_description" cols="30" rows="3" placeholder="Short description wrote here.." required></textarea>
                        -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Description*</b></label>
                            <vue-editor v-model="description" name="description" ></vue-editor>
<!--                            <textarea id="editor" class="form-control  summernote" name="description" cols="30" rows="3" placeholder="Description wrote here.." required></textarea>
                        -->
                        </div>
                    </div>
                </template>
                <div class="col-md-12" v-if="design_type===6">
                    <div class="form-group">
                        <label><b>Short Description*</b></label>
                        <vue-editor v-model="short_description" name="short_description" ></vue-editor>
                        <!--                            <textarea id="editor" class="form-control summernote" name="short_description" cols="30" rows="3" placeholder="Short description wrote here.." required></textarea>
                                                -->
                    </div>
                </div>
                <div class="col-md-12"></div>

                <div class="card-footer">
                    <b-button type="submit" v-if="is_loading" variant="success" disabled>
                        <b-spinner small></b-spinner>
                        publishing...
                    </b-button>
                    <b-button type="submit" v-if="!is_loading" variant="success">
                        publish
                    </b-button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Vue from 'vue'
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import { BButton,BSpinner  } from 'bootstrap-vue'
import { VueEditor } from "vue2-editor";
Vue.use(Toaster, {timeout: 5000})
import axios from "axios";
export default {
    props:{
        section_names:{
            type:Array,
            required:true,
        },
        section_design_types:{
            type:Array,
            required:true,
        },
        app_url:{
            required:true,
        }
    },
    components:{
        BButton,BSpinner,VueEditor,
    },
    data(){
      return{
          design_type:null,
          section_name_id:null,
          section_design_id:null,
          is_loading:false,
          optional_designs:[2,3,6,7,8,9],
          short_description:'',
          description:'',
          colour: '#000000',
      }
    },
    methods:{
        btnLoad(){
            $('.btn').on('click', function() {
                var $this = $(this);
                $this.button('loading');
                setTimeout(function() {
                    $this.button('reset');
                }, 8000);
            });
        },
        async sectionSubmit(){
            this.is_loading=true;
            let data =new FormData(this.$refs.section_add_form);
            data.append('short_description',this.short_description);
            data.append('description',this.description);
            await axios.post(`${this.app_url}/adminx/frontend/section/store`,data).then((response)=>{
                this.is_loading=false;
                this.$refs.section_add_form.reset();
                if (response.data.status ==='success') {
                    this.$toaster.success(response.data.message);
                    window.location.reload();
                }
                else this.$toaster.error(response.data.message);
            }).catch((error)=>{
                this.is_loading=false;
                if (error.response.status === 422) {
                    Object.keys(error.response.data.errors).map((field) => {
                        this.$toaster.error(error.response.data.errors[field][0]);
                    });
                } else this.$toaster.error(error.response.data.message);
            })
        },
        /*on section type change */
        changeSection(){
            if (this.section_name_id !== null && this.section_names.length>0){
                let ind = this.section_names.find(item=>item.id===this.section_name_id);
                if(ind) this.section_design_id = ind.section_design_type_id;
            }else{
                this.section_design_id=null;
            }
        }
    },
    watch:{
        section_name_id(){
            this.changeSection();
        },
        section_names(){
            this.changeSection();
        }
    }
}

</script>
<style>
.custom_image_size{
    width: 45%;
}
</style>
