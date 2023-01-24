<template>
    <div>
        <div class="row border" v-for="(item,key) in items" :key="key">
            <div class="col-sm-3">
                <div class="form-group">
                    <label><b>Member Type</b></label>
                    <input name="name" class="form-control" placeholder="member type" type="text" required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label><b>Position</b></label>
                    <input name="position" class="form-control" type="number" step="any" value="1" required>
                </div>
            </div>
            <div class="col-sm-2">
                <b-form-group label="Payment type"  v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        v-model="item.payment_type"
                        :options="options"
                        :aria-describedby="ariaDescribedby"
                        name="payment_option"
                    ></b-form-radio-group>
                </b-form-group>
            </div>
            <div class="col-sm-3" v-if="parseInt(item.payment_type) !== 2">
                <div class="form-group">
                    <label><b>Amount</b></label>
                    <input name="amount" class="form-control" placeholder="amount here" type="number" step="any" required>
                </div>
            </div>
            <div class="col-sm-2">
                <b-form-group label="Member Limit" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        v-model="item.join_limit"
                        :options="options2"
                        :aria-describedby="ariaDescribedby"
                        name="join_limit"
                    ></b-form-radio-group>
                </b-form-group>
            </div>
            <div class="col-sm-3" v-if="parseInt(item.join_limit) === 1">
                <div class="form-group">
                    <label><b>Limit</b></label>
                    <input name="limit" class="form-control" placeholder="member limit" type="number" step="any" required>
                </div>
            </div>
            <div class="col-sm-12 container border" v-for="(itm,key2) in item.items" :key="key2">
                <div class="row" >
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><b>Input type *</b></label>
                            <select class="form-control" :name="'type['+key2+']'" v-model="itm.input_type" required>
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="date">Date</option>
                                <option value="image">Image</option>
                                <option value="file">File</option>
                                <option value="radio">Radio</option>
                                <option value="dropdown">Dropdown</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><b>label</b></label>
                            <input :name="'label['+key2+']'" class="form-control" placeholder="lable write here" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><b>Name</b></label>
                            <input :name="'input_name['+key2+']'" class="form-control" placeholder="input name write here" type="text" required>
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
                                    <input :name="'value['+key2+'][]'" class="form-control" v-model="op.name" placeholder="option here" type="text" required>
                                </div>
                            </div>
                            <!-- Remove Button -->
                            <div class="col-sm-1">
                                <div class="form-group" v-if="itm.options.length>1">
                                    <i class="fa fa-trash mt-5" @click="removeItemOption(key,key2,key3)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                                </div>
                            </div>
                            <div class="col-sm-1" v-show="itm.options.length === (key3+1)">
                                <div class="form-group" >
                                    <i class="fa fa-plus-circle mt-5" @click="repeateAgainOption(key,key2)" aria-hidden="true" style="color: green; cursor: pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Remove Button -->
                    <div class="col-sm-2" v-if="item.items.length>1">
                        <div class="form-group" >
                            <i class="fa fa-trash mt-5" @click="removeItemInput(key,key2)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2" v-if="item.items.length ===(key2+1)">
                    <div class="form-group" >
                        <i class="fa fa-plus-circle mt-1" @click="repeateAgainInput(key)" aria-hidden="true" style="color: green; cursor: pointer"></i>
                    </div>
                </div>
            </div>
<!--            <hr>
            <div class="col-sm-2">
                <div class="form-group" >
                    <i v-if="items.length>1" class="fa fa-trash mt-1" @click="removeItem(key)" aria-hidden="true" style="color: red; cursor: pointer"></i>
                    <i v-if="items.length === (key+1)" class="fa fa-plus-circle mt-1" @click="repeateAgain()" aria-hidden="true" style="color: green; cursor: pointer"></i>
                </div>
            </div>-->
        </div>
    </div>
</template>
<script>
import { BFormGroup, BFormRadioGroup, BFormRadio } from 'bootstrap-vue'
export default {
    name:'MemberType',
    components:{
        BFormRadioGroup, BFormGroup,BFormRadio
    },
    data(){
        return{
            items: [
                {
                    id: 1,
                    name:'',
                    position:'',
                    payment_type:1,
                    amount:null,
                    join_limit:1,
                    limit:1000,
                    items:[{
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
                    }],
                    prevHeight: 0,
                }
            ],
            options: [
                { text: 'Paid', value: 1 },
                { text: 'Free', value: 2 }
            ],
            options2: [
                { text: 'Yes', value: 1 },
                { text: 'No', value: 0 },
            ]
        }
    },
    methods:{
        repeateAgain() {
            this.items.push({
                id: 1,
                name:'',
                position:'',
                payment_type:1,
                amount:null,
                join_limit:1,
                limit:1000,
                items:[{
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
                }],
                prevHeight: 0,
            })
        },
        repeateAgainInput(index){
            this.items[index].items.push({
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
        repeateAgainOption(index,index2){
            this.items[index].items[index2].options.push({
                id:1,
                name:'',
            });
        },
        removeItemOption(index,index2,index3) {
            this.items[index].items[index2].options.splice(index3, 1)
        },
        removeItemInput(index,index2) {
            this.items[index].items.splice(index2, 1)
        },
        removeItem(index) {
            this.items.splice(index, 1)
        },
    }
}
</script>
