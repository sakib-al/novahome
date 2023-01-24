<template>
    <div>
        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" @submit="sectionSubmit()" ref="section_update_form" id="productForm">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Section Name*</b></label>
                                    <input type="text" name="section_name" v-model="home_section.section_name" class="form-control" placeholder="write section here" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Display section title *</b></label>
                                    <select class="form-control" v-model="home_section.section_name_is_show" name="section_name_is_show" required>
                                        <option :value="1">Yes</option>
                                        <option :value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Background color *</b></label>
                                    <input type="color" name="background_color" v-model="home_section.background_color" class="form-control colorpicker"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Status *</b></label>
                                        <select class="form-control" v-model.number="home_section.status" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            <template v-if="parseInt(home_section.section_design_type_id) ===2 || parseInt(home_section.section_design_type_id) === 3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Number of Column *</b></label>
                                        <select class="form-control" v-model="home_section.col" name="col" required>
                                            <option value="3">3</option>
                                            <option value="4">4</option>>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Number of row *</b></label>
                                        <input type="number" name="row" v-model="home_section.row" class="form-control" placeholder="write number of row here" required>
                                    </div>
                                </div>
                            </template>
                            <template v-if="!optional_designs.includes(parseInt(home_section.section_design_type_id))">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Title *</b></label>
                                        <input type="text" class="form-control form-control-sm" v-model="home_section.title" name="title" placeholder="Title write here.." required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Sub Title</b></label>
                                        <input type="text" class="form-control form-control-sm" v-model="home_section.sub_title" name="sub_title" placeholder="Sub Title write here..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Text Align</b></label>
                                        <select class="form-control" v-model="home_section.text_align" name="text_align">
                                            <option  value="1">Left</option>
                                            <option  value="2">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Button Name</b></label>
                                        <input type="text" class="form-control form-control-sm" v-model="home_section.button_name" name="button_name" placeholder="button name write here..">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Button URL</b></label>
                                        <input type="text" class="form-control form-control-sm" v-model="home_section.button_url" name="button_url" placeholder="button url write here..">
                                    </div>
                                </div>
                                <template v-if="parseInt(home_section.section_design_type_id) === 3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Raised Amount</b></label>
                                            <input type="number" class="form-control form-control-sm" v-model="home_section.raised_amount" name="raised_amount" step="any" placeholder="raised amount write here..">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Raised Percentage</b></label>
                                            <input type="number" class="form-control form-control-sm" v-model="home_section.raised_percentage" name="raised_percentage" step="any" placeholder="raised percentage write here..">
                                        </div>
                                    </div>
                                </template>
                                <div class="col-md-4" v-if="parseInt(home_section.section_design_type_id) === 4">
                                    <div class="form-group">
                                        <label><b>Template</b></label>
                                        <select class="form-control" v-model="home_section.parallax_option" name="parallax_option">
                                            <option  value="1">Vote</option>
                                            <option  value="2">Opinion</option>
                                        </select>
                                    </div>
                                </div>
                            </template>

                        </div>
                        <div class="col-md-3" v-if="!optional_designs.includes(parseInt(home_section.section_design_type_id))">
                            <div class="col-md-12">
                                <div class="card border-light mt-3 shadow">
                                    <div class="card-body">
                                        <img class="img-thumbnail uploaded_img"  :src="image_path?image_path:'/img/default-img.png'" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <label><b>Image*</b></label>
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>Display Image Inner Border *</b></label>
                                        <select class="form-control" v-model="home_section.is_image_inner_border" name="is_image_inner_border" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <template v-if="!optional_designs.includes(parseInt(home_section.section_design_type_id)) && parseInt(home_section.section_design_type_id) !== 4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Short Description*</b></label>
                            <vue-editor v-model="home_section.short_description" name="short_description" ></vue-editor>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Description*</b></label>
                            <vue-editor v-model="home_section.description" name="description" ></vue-editor>
                        </div>
                    </div>
                </template>
                <div class="col-md-12" v-if="parseInt(home_section.section_design_type_id)===6">
                    <div class="form-group">
                        <label><b>Short Description*</b></label>
                        <vue-editor v-model="home_section.short_description" name="short_description" ></vue-editor>
                    </div>
                </div>
                <div class="col-md-12"></div>

                <div class="card-footer">
                    <b-button type="submit" v-if="is_loading" variant="success" disabled>
                        <b-spinner small></b-spinner>
                        updating...
                    </b-button>
                    <b-button type="submit" v-if="!is_loading" variant="success">
                        Update
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
        home_section:{
            type:Object,
            required:true,
        },
        image_path:{
            required: false,
        },
        app_url:{
            required:true,
        }
    },
    components:{
        BButton,BSpinner,VueEditor
    },
    created() {
        //this.section_design_type_id=this.home_section.section_design_type_id;
    },
    data(){
      return{
          section_design_type_id:null,
          is_loading:false,
          optional_designs:[2,3,6,7,8,9],
          short_description:'',
          description:'',
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
            let data =new FormData(this.$refs.section_update_form);
            data.append('short_description',this.home_section.short_description);
            data.append('description',this.home_section.description);
           await axios.post(`${this.app_url}/adminx/frontend/section/update${this.home_section.id}`,data).then((response)=>{
                this.is_loading=false;
                //this.$refs.section_update_form.reset();
                if (response.data.status === 'success') {
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
    },
    watch:{

    }
}
</script>
<style>
.custom_image_size{
    width: 45%;
}
</style>
