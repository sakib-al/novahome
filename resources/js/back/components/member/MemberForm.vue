<template>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label><b>Member Type *</b></label>
                <select class="form-control" name="member_type_id" v-model.number="member_type_id" required>
                    <option :value="null">Select One</option>
                    <option v-for="(type,key) in member_types" :value="type.id" :key="key">{{ type.name }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" v-if="parseInt(is_free)===1">
            <div class="form-group">
                <label><b>Payment Option *</b></label>
                <select class="form-control" name="amount" v-model="info['amount']" required>
                    <option :value="amount" >$ {{ amount }}</option>
                    <option :value="null" > Free </option>
                </select>
            </div>
        </div>
        <div class="col-md-4" v-if="parseInt(is_free)===3">
            <div class="form-group">
                <label><b>Payable Amount(USD) *</b></label>
                <input class="form-control" name="amount" v-model="amount" type="text" readonly  required>
            </div>
        </div>
        <template v-for="(item,key) in items">
            <div class="col-md-4" v-if="item.input_type==='text' || item.input_type==='email' || item.input_type==='date'">
                <div class="form-group">
                    <label><b>{{ item.label }}</b></label>
                    <input class="form-control" :name="item.input_name" :value="info[item.input_name]"  :type="item.input_type" :placeholder="'write '+ item.input_name"  :required="!!item.is_required">
                </div>
            </div>
            <div class="col-md-4" v-if="item.input_type==='image'">
                <div class="form-group">
                    <label><b>{{ item.label }}</b></label>
                    <input class="form-control" :name="item.input_name" type="file" accept="image/jpeg;image/jpg;image/png" :placeholder="'write '+ item.input_name" >
                </div>
            </div>
            <div class="col-md-4" v-if="item.input_type==='file'">
                <div class="form-group">
                    <label><b>{{ item.label }}</b></label>
                    <input class="form-control" :name="item.input_name" type="file" :placeholder="'write '+ item.input_name" >
                </div>
            </div>
            <div class="col-md-4" v-if="item.input_type==='dropdown'">
                <div class="form-group">
                    <label><b>{{ item.label }}</b></label>
                    <select class="form-control" :name="item.input_name" v-model="info[item.input_name]" :required="!!item.is_required">
                        <option v-for="(op,key2) in item.options" :value="op" :key="key2">{{ op }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-if="item.input_type==='radio'">
                <div class="form-group">
                    <label><b>{{ item.label }}</b></label>
                    <b-form-group v-slot="{ ariaDescribedby }">
                        <b-form-radio-group class="form-control" v-model="info[item.input_name]"
                            :options="item.options"
                            :aria-describedby="ariaDescribedby"
                            :name="item.input_name"
                            :required="!!item.is_required"
                        ></b-form-radio-group>
                    </b-form-group>
                </div>
            </div>
        </template>
    </div>
</template>
<script>
import { BFormGroup, BFormRadioGroup, BFormRadio } from 'bootstrap-vue'
export default {
    name:'EventForm',
    components:{
        BFormRadioGroup, BFormGroup,BFormRadio
    },
    props:{
        member_types:{
            required:true,
        },
        user:{
            required: false,
        },
    },
    data(){
        return{
            member_type_id:null,
            items:[],
            amount:0,
            is_free:null,
            info:{},
        }
    },
    created() {
        this.findItem();
        if (this.user){
            this.member_type_id=parseInt(this.user.member_type_id);
            this.info=this.jsonDecode2(this.user.info);
        }
    },
    methods:{
        jsonDecode2(data){
            try{
                return JSON.parse(data);
            }catch ($e){
                return {};
            }
        },
        jsonDecode(data){
            try{
                return JSON.parse(data);
            }catch ($e){
                return []
            }
        },
        findItem(){
            if (this.member_type_id){
                let index = this.member_types.findIndex(item=>parseInt(item.id)===this.member_type_id);
                if (index>=0){
                    this.amount=this.member_types[index].amount;
                    this.is_free=this.member_types[index].is_free===0?1:(this.member_types[index].is_free===1 && this.member_types[index].amount>0)?3:2;
                    this.items = this.jsonDecode(this.member_types[index].attributes);
                }else{
                    this.amount=0;
                    this.is_free=null;
                    this.items=[];
                }

            }else{
                this.items=[];
            }
        },
    },
    watch:{
        member_type_id(){
            this.findItem();
        },
    }
}
</script>
