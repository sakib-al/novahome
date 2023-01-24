<template>
    <div>
        <div class="col-md-12">
            <label><b>Frequency of Payment *</b></label>
            <div class="row col-md-12" v-for="(op,key3) in options3" :key="key3">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><b>Option {{ (key3+1) }}</b></label>
                        <input name="f_of_payments[]" class="form-control" :value="op" placeholder="option here" type="text" required>
                    </div>
                </div>
                <!-- Remove Button -->
                <div class="col-sm-1">
                    <div class="form-group" v-if="options3.length>1">
                        <i class="fa fa-trash mt-5" @click="removeFp(key3)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                    </div>
                </div>
                <div class="col-sm-1" v-show="options3.length === (key3+1)">
                    <div class="form-group" >
                        <i class="fa fa-plus-circle mt-5" @click="repeateFp" aria-hidden="true" style="color: green; cursor: pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><b>Default amount *</b></label>
                <div class="row col-md-12" v-for="(op,key3) in options4" :key="key3">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><b>Option {{ (key3+1) }}</b></label>
                            <input name="default_amounts[]" class="form-control" :value="op" placeholder="option here" type="text" required>
                        </div>
                    </div>
                    <!-- Remove Button -->
                    <div class="col-sm-1">
                        <div class="form-group" v-if="options4.length>1">
                            <i class="fa fa-trash mt-5" @click="removeAmount(key3)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                        </div>
                    </div>
                    <div class="col-sm-1" v-show="options4.length === (key3+1)">
                        <div class="form-group" >
                            <i class="fa fa-plus-circle mt-5" @click="repeateAmount" aria-hidden="true" style="color: green; cursor: pointer"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border">
            <div class="col-sm-12 container border" v-for="(itm,key2) in items" :key="key2">
                <div class="row" >
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><b>Input type *</b></label>
                            <select class="form-control" :name="'type['+key2+']'" v-model="itm.input_type" required>
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="date">Date</option>
<!--                                <option value="image">Image</option>
                                <option value="file">File</option>-->
                                <option value="radio">Radio</option>
                                <option value="dropdown">Dropdown</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><b>label</b></label>
                            <input :name="'label['+key2+']'" class="form-control" v-model="itm.label" placeholder="label write here" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><b>Name (no space accept)</b></label>
                            <input :name="'input_name['+key2+']'" class="form-control" v-model="itm.input_name" placeholder="field name write here" type="text" pattern="^\S+$" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <b-form-group label="Required Field" v-slot="{ ariaDescribedby }">
                            <b-form-radio-group
                                v-model.number="itm.is_required"
                                :options="options2"
                                :aria-describedby="ariaDescribedby"
                                :name="'is_required['+key2+']'"
                            ></b-form-radio-group>
                        </b-form-group>
                    </div>
                    <div class="col-md-12" v-if="itm.input_type === 'dropdown' || itm.input_type === 'radio'">
                        <div class="row col-md-12" v-for="(op,key3) in itm.options" :key="key3">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label><b>Option {{ (key3+1) }}</b></label>
                                    <input :name="'value['+key2+'][]'" class="form-control" :value="op" placeholder="option here" type="text" required>
                                  </div>
                            </div>
                            <!-- Remove Button -->
                            <div class="col-sm-1">
                                <div class="form-group" v-if="itm.options.length>1">
                                    <i class="fa fa-trash mt-5" @click="removeItemOption(key2,key3)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                                </div>
                            </div>
                            <div class="col-sm-1" v-show="itm.options.length === (key3+1)">
                                <div class="form-group" >
                                    <i class="fa fa-plus-circle mt-5" @click="repeateAgainOption(key2)" aria-hidden="true" style="color: green; cursor: pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Remove Button -->
                    <div class="col-sm-2" v-if="items.length>1">
                        <div class="form-group" >
                            <i class="fa fa-trash mt-5" @click="removeItemInput(key2)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2" v-if="items.length ===(key2+1)">
                    <div class="form-group" >
                        <i class="fa fa-plus-circle mt-1" @click="repeateAgainInput" aria-hidden="true" style="color: green; cursor: pointer"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { BFormGroup, BFormRadioGroup, BFormRadio } from 'bootstrap-vue'
export default {
    name:'Donation',
    components:{
        BFormRadioGroup, BFormGroup,BFormRadio
    },
    props:{
        donation:{
            required:false,
        }
    },
    data(){
        return{
            items:[{
                id:1,
                input_type:'text',
                label:'',
                name:'',
                is_required:1,
                options:['option'],
            }],
            options2: [
                { text: 'Yes', value: 1 },
                { text: 'No', value: 0 },
            ],
            options3: ['Monthly','Half Yearly','Yearly'],
            options4: [50,100,200,500],
        }
    },
    created() {
        if (this.donation){
            this.items=this.jsonDecode(this.donation.fields);
            this.options3=this.jsonDecode(this.donation.f_of_payment);
            this.options4=this.jsonDecode(this.donation.default_amounts);
        }
    },
    methods:{
        jsonDecode(dt){
            try{
                return JSON.parse(dt);
            }catch (e){
                return [];
            }
        },
        repeateFp(){
            this.options3.push('');
        },
        repeateAmount(){
            this.options4.push(50);
        },
        repeateAgainInput(){
            this.items.push({
                id:1,
                input_type:'text',
                label:'',
                name:'',
                is_required:1,
                options:[
                    {
                        id:1,
                        name:'',
                    }
                ],
            });
        },
        repeateAgainOption(index2){
            this.items[index2].options.push('option');
        },
        removeItemOption(index2,index3) {
            this.items[index2].options.splice(index3, 1)
        },
        removeItemInput(index2) {
            this.items.splice(index2, 1)
        },
        removeFp(index2) {
            this.options3.splice(index2, 1)
        },
        removeAmount(index2) {
            this.options4.splice(index2, 1)
        },
    }
}
</script>
