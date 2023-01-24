<template>
    <div>
<!--        <select class="form-control col-md-3 mb-2" v-model="join_type_id">
            <option :value="null" >Select One</option>
            <option v-for="(type,key) in join_types" :value="type.id" :key="key">{{ type.name }}</option>
        </select>-->
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">SL.</th>
                    <th scope="col">Join Type</th>
                    <template>
                        <th v-for="(lb,key2) in labels" :key="key2">{{ lb.label }}</th>
                    </template>
                    <th >Amount</th>
                    <th >Payment Status</th>
                    <th >Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ej,key3) in event_joins" :key="key3">
                    <td></td>
                    <td>{{ (key3+1) }}</td>
                    <td>{{ findJoinType(ej.join_type_id) }}</td>
                    <td v-for="(lb,key4) in labels" :key="key4">
                        {{ jsonDecode2(ej.values)?jsonDecode2(ej.values)[convertToSlug(lb.input_name)]:'' }}
                    </td>
                    <td>{{ ej.amount }}</td>
                    <td>{{ ej.payment_status==1?'Paid':'Unpaid' }}</td>
                    <td>
                        <b-form-checkbox  :name="'check-button'+key3" :id="'check-button'+key3"
                                          @change="statusChange(ej.id)" v-model="ej.status" :value="1" switch>
                        </b-form-checkbox>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
//Bootstrap and jQuery libraries
/*import 'bootstrap/dist/css/bootstrap.min.css'; //for table good looks
import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import "datatables.net-buttons/js/dataTables.buttons.js"
import "datatables.net-buttons/js/buttons.colVis.js"
import "datatables.net-buttons/js/buttons.flash.js"
import "datatables.net-buttons/js/buttons.html5.js"
import "datatables.net-buttons/js/buttons.print.js"
import $ from 'jquery';*/
import axios from "axios";
import {
    BFormCheckbox
} from 'bootstrap-vue'
export default {
    name:'memberTable',
    props:{
        join_types:{
            required:true,
        },
        event_joins:{
            required:true,
            type:Array,
        },
        app_url:{
            required:true,
        }
    },
    components:{BFormCheckbox},
    data(){
        return{
            labels:[],
            join_type_id:null,
            //users:[],
        }
    },
    created(){
        this.findLabels();
        //this.filterUser();
    },
    methods:{
        convertToSlug(Text){
            return  Text.replace(/ /g,'_')
                .replace(/[^\w-]+/g,'');
        },
        jsonDecode2(dt){
            try{
                return JSON.parse(dt);
            }catch (e){
                return null;
            }
        },
        jsonDecode(dt){
            try{
                return JSON.parse(dt);
            }catch (e){
                return [];
            }
        },
        findLabels(){
            /*if (this.join_type_id){
                let index = this.join_types.findIndex(item=>item.id===this.join_type_id);

                if (index>=0){
                    this.labels=this.jsonDecode(this.join_types[index].attributes);
                }else{
                    this.labels=[];
                }
            }else{
                this.labels=[];
            }*/
            let lbs = this.join_types.map(item=>this.jsonDecode(item.attributes));
            lbs.forEach(item=>{
               this.labels.push(...item)
            });
        },
        findJoinType(id){
            console.log(id);
            let index = this.join_types.findIndex(item=>parseInt(item.id)===parseInt(id));
            console.log(index);
            if(index>=0){
                return this.join_types[index].name;
            }else return null;
        },
        /*filterUser(){
            this.users = this.event_joins.filter(item=>item.join_type_id === this.join_type_id);
        }*/

        statusChange(id){
            axios.put(`${this.app_url}/adminx/event/member/status/change${id}`).then((response)=>{
                console.log('change');
            }).catch(()=>{
                console.log('error');
            });
        },
    },
    watch:{
        join_type_id(){
            this.findLabels();
            //this.filterUser();
        },
        /*event_joins(){
            this.filterUser();
        }*/
    }
}
</script>
