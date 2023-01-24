<template>
    <div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Join as</label>
            <div class="col-sm-8">
                <select class="form-control" name="join_type_id" v-model.number="join_type_id" required>
                    <option :value="null">Select One</option>
                    <option v-for="(type,key) in join_types" :value="type.id" :key="key">{{ type.name }}</option>
                </select>
            </div>
        </div>
<!--        <template v-if="join_type_id">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Your Name</label>
                <div class="col-sm-8">
                    <input class="form-control" name="name" type="text"  placeholder="Type Your Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Your Mobile Number</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="phone_number" placeholder="Type Your Mobile Number">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Your Email Address</label>
                <div class="col-sm-8">
                    <input class="form-control" name="email" type="email"   placeholder="Type Email Address" required>
                </div>
            </div>
        </template>-->
        <div class="form-group row" v-if="auth_id ==='' ">
            <label class="col-sm-4 col-form-label">Your Email Address</label>
            <div class="col-sm-8">
                <input class="form-control" name="email" type="email"   placeholder="Type Email Address" required>
            </div>
        </div>
        <div class="form-group row" v-if="parseInt(is_free)===0">
            <label class="col-sm-4 col-form-label">Payable Amount(USD)</label>
            <div class="col-sm-8">
                <input class="form-control" name="amount" v-model="amount" type="text" readonly  required>
            </div>
        </div>
        <div v-for="(item,key) in items" :key="key">
            <div v-if="item.input_type==='text' || item.input_type==='email' || item.input_type==='date'" class="form-group row">
                <label class="col-sm-4 col-form-label">{{ item.label }}</label>
                <div class="col-sm-8">
                    <input class="form-control" :name="item.input_name" :type="item.input_type" :placeholder="item.input_name"  :required="!!item.is_required">
                </div>
            </div>
            <div v-if="item.input_type==='dropdown'" class="form-group row">
                <label class="col-sm-4 col-form-label">{{ item.label }}</label>
                <div class="col-sm-8">
                    <select class="form-control" :name="item.input_name" :required="!!item.is_required">
                        <option :value="null">Select One</option>
                        <option v-for="(op,key2) in item.options" :value="op" :key="key2">{{ op }}</option>
                    </select>
                </div>
            </div>
            <div v-if="item.input_type==='radio'" class="form-group row">
                <label class="col-sm-4 col-form-label">{{ item.label }}</label>
                <div class="col-sm-8">
                    <b-form-group v-slot="{ ariaDescribedby }">
                        <b-form-radio-group
                            :options="item.options"
                            :aria-describedby="ariaDescribedby"
                            :name="item.input_name"
                            :required="!!item.is_required"
                        ></b-form-radio-group>
                    </b-form-group>
                </div>
            </div>
        </div>
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
        join_types:{
            required:true,
        },
        auth_id:{
            required:false,
        }
    },
    data(){
        return{
            join_type_id:null,
            items:[],
            amount:0,
            is_free:null,
        }
    },
    created() {
        this.findItem();
    },
    methods:{
        jsonDecode(data){
            try{
                return JSON.parse(data);
            }catch ($e){
                return []
            }
        },
        findItem(){
            if (this.join_type_id){
                let index = this.join_types.findIndex(item=>item.id===this.join_type_id);
                if (index>=0){
                    this.amount=this.join_types[index].amount;
                    this.is_free=this.join_types[index].is_free;
                    this.items = this.jsonDecode(this.join_types[index].attributes);
                }else{
                    this.amount=0;
                    this.is_free=null;
                    this.items=[];
                }

            }else{
                this.items=[];
            }
        }
    },
    watch:{
        join_type_id(){
            this.findItem();
        },
    }
}
</script>
