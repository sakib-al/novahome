<template>
    <b-overlay :show="is_loading" rounded="sm" :opacity="0.50">
        <div class="card mb-4" :aria-hidden="is_loading ? 'true' : null">
            <div class="card-header card-img-wrap" v-if="questions.length<1">
                <img :src="img_path" width="100%" :alt="vote.title">
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h2>{{ vote.title }}</h2>
                    <i class=" fa-4x mb-3 text-primary"></i>
                    <div v-html="vote.short_description"></div>
                </div>
                <hr >
                    <form class="px-7 pr-7" action="javascript:void(0)" ref="vote_form" >

                        <input type="hidden" :value="vote.id"  name="vote_id">
                        <template v-if="questions.length<1">
                            <input type="hidden" value="1" ref="type_input" name="type">
                            <div class="form-check mb-2" id="comment_div">
                                <div class="col-md-12">
                                    <input v-if="is_vote" class="form-check-input" type="radio" v-model="q_answer" disabled  name="answer" value="Yes" id="radio3Example1" required>
                                    <input v-else class="form-check-input" type="radio" v-model="q_answer"  name="answer" value="Yes" id="radio3Example1" required>
                                    <label class="form-check-label" for="radio3Example1">
                                        Yes
                                    </label>
                                    <span class="float-right">{{votePercentage('Yes')}}%</span>
                                </div>
                            </div>
                            <div class="form-check mb-2" id="comment_div">
                                <div class="col-md-12">
                                    <input class="form-check-input" v-if="is_vote" type="radio" name="answer" disabled v-model="q_answer" value="No" id="radio3Example2" >
                                    <input class="form-check-input" v-else type="radio" name="answer" v-model="q_answer" value="No" id="radio3Example2" >
                                    <label class="form-check-label" for="radio3Example2">
                                        No
                                    </label>
                                    <span class="float-right">{{votePercentage('No')}}%</span>
                                </div>
                            </div>
                            <div class="form-check mb-2" id="comment_div">
                                <div class="col-md-12">
                                    <input class="form-check-input" v-if="is_vote" type="radio" value="No Comments" disabled v-model="q_answer" name="answer" id="radio3Example3" >
                                    <input class="form-check-input" v-else type="radio" value="No Comments" v-model="q_answer" name="answer" id="radio3Example3" >
                                    <label class="form-check-label" for="radio3Example3">
                                        No Comments
                                    </label>
                                    <span class="float-right">{{votePercentage('No Comments')}}%</span>
                                </div>
                            </div>
                            <div class="form-check mb-2 pl-0 d-inline-block">
                                <!--                        <button v-if="is_vote" type="button" @click="changeVote()" class="animated-button6 bt_back nav">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            Change Vote
                                                        </button>-->
                                <button v-if="!is_vote" type="submit" @click="submitForm()" class="animated-button6 bt_back nav">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Vote
                                </button>
                            </div>
                        </template>
                        <template v-else>
                            <input type="hidden" ref="type_input" value="2" name="type">
                            <div class="col-md-12" v-for="(qn,key) in question" :key="key">
                                <div class="form-group" v-if="qn.type==='Input'">
                                    <label>{{qn.question }}</label>
                                    <input v-if="is_vote" :name="'answer['+qn.id+']'" v-model="q_answer[qn.id]" type="text" class="form-control" placeholder="your answer" disabled required/>
                                    <input v-else :name="'answer['+qn.id+']'" v-model="survey_ans[qn.id]" type="text" class="form-control" placeholder="your answer" required/>
                                </div>
                                <div class="form-group" v-else-if="qn.type==='Yes/No'">
                                    <label>{{qn.question }}</label>
                                    <b-form-group v-if="is_vote" v-slot="{ ariaDescribedby }" required disabled>
                                        <b-form-radio :aria-describedby="ariaDescribedby" v-model="q_answer[qn.id]" :name="'answer['+qn.id+']'" value="Yes">Yes</b-form-radio>
                                        <b-form-radio :aria-describedby="ariaDescribedby" v-model="q_answer[qn.id]" :name="'answer['+qn.id+']'" value="No">No</b-form-radio>
                                    </b-form-group>
                                    <b-form-group v-else v-slot="{ ariaDescribedby }" required>
                                        <b-form-radio :aria-describedby="ariaDescribedby" v-model="survey_ans[qn.id]" :name="'answer['+qn.id+']'" value="Yes">Yes</b-form-radio>
                                        <b-form-radio :aria-describedby="ariaDescribedby" v-model="survey_ans[qn.id]" :name="'answer['+qn.id+']'" value="No">No</b-form-radio>
                                    </b-form-group>
                                </div>
                                <div class="form-group" v-else-if="qn.type==='Option'">
                                    <label>{{qn.question }}</label>
                                    <select v-if="is_vote" :name="'answer['+qn.id+']'" v-model="q_answer[qn.id]" class="form-control" required disabled>
                                        <option v-for="(op,key) in JSON.parse(qn.options)" :key="key">{{ op }}</option>
                                    </select>
                                    <select v-else :name="'answer['+qn.id+']'" v-model="survey_ans[qn.id]" class="form-control" required>
                                        <option v-for="(op,key) in JSON.parse(qn.options)" :key="key">{{ op }}</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" v-if="!is_vote" @click="submitForm()" class="animated-button6 bt_back nav ml-2">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Submit
                            </button>
                        </template>

                        <a v-if="!all_page" :href="app_url+'/vote/all'" class="button tn_load_more_btn button_view_all mt-0 float-right">View All</a>
                    </form>
            </div>
        </div>
    </b-overlay>
</template>
<script>
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import { BButton,BSpinner,BFormGroup,BFormRadio,BOverlay  } from 'bootstrap-vue'
import Vue from "vue";
Vue.use(Toaster, {timeout: 5000})
import axios from "axios";
export default {
    name:'Vote',
    props:{
        app_url:{
            required:true,
        },
        vote:{
            required: true,
            type:Object,
        },
        img_path:{
            required:false
        },
        answers:{
            required:true,
        },
        user_id:{
            required:false,
        },
        ip:{
            required:true,
        },
        all_page:{
            required:false,
        },
        questions:{
            required:true,
        },
    },
    components:{
        BButton,BSpinner,BFormGroup,BFormRadio,BOverlay
    },
    data(){
        return{
            answer:[],
            is_loading:false,
            is_vote:false,
            q_answer: null,
            question:[],
            survey_ans:{},//survey current answer model
        }
    },
    created() {
        this.answer=this.answers;
        this.question=this.questions;
        this.isVote();
    },
    methods:{
        doAjax() {
            this.isLoading = true;
            // simulate AJAX
            setTimeout(() => {
                this.isLoading = false
            }, 5000)
        },
        onCancel() {
            console.log('User cancelled the loader.')
        },

        async submitForm(){
            this.is_loading=true;
            let data =new FormData(this.$refs.vote_form);
            await axios.post(`${this.app_url}/vote/store`,data).then((response)=>{
                this.$toaster.success(response.data.message);
                if(parseInt(this.$refs.type_input.value) === 1) {
                    this.addVote();
                }//update current vote
                else {
                    this.addSurvey();
                    //this.$refs.vote_form.reset();
                }
                this.is_loading=false;
                this.is_vote=true;
            }).catch((error)=>{
                this.is_loading=false;
                if (error.response.status === 422) {
                    Object.keys(error.response.data.errors).map((field) => {
                        this.$toaster.error(error.response.data.errors[field][0]);
                    });
                } else this.$toaster.error(error.response.data.message);
            })
        },
        addSurvey(){
            let vt = this.jsonDecode(this.answer);
            vt.push(
                {
                    "user_id":this.user_id,
                    "vote_id":this.vote.id,
                    "vote_question_id":null,
                    "answer":this.survey_ans,
                    "ip":this.ip,
                }
            );
            this.survey_ans={};
            this.answer=JSON.stringify(vt);
        },
        addVote(){
          let vt = this.jsonDecode(this.answer);
          /*let index = vt.findIndex(item=>parseInt(item.user_id)===parseInt(this.user_id) && parseInt(item.vote_id)===parseInt(this.vote.id));
          if (index>=0){
              vt[index].answer=this.q_answer;
              vt[index].ip=this.ip;
          }else{
              vt.push(
                  {
                      "user_id":this.user_id,
                      "vote_id":this.vote.id,
                      "vote_question_id":null,
                      "answer":this.q_answer,
                      "ip":this.ip,
                  }
              );
          }*/
            vt.push(
                {
                    "user_id":this.user_id,
                    "vote_id":this.vote.id,
                    "vote_question_id":null,
                    "answer":this.q_answer,
                    "ip":this.ip,
                }
            );
          this.answer=JSON.stringify(vt);
        },
        jsonDecode(data){
            try{
                return JSON.parse(data);
            }catch ($e){
                return data
            }
        },
        changeVote(){
          this.is_vote=false;
        },
        isVote(){
            if (this.user_id){
                var dd = this.jsonDecode(this.answer).map((item)=>{
                    if (parseInt(item.vote_id)===parseInt(this.vote.id) && parseInt(item.user_id)===parseInt(this.user_id)) return item;
                }).filter(Boolean);
            }else{
                var dd = this.jsonDecode(this.answer).map((item)=>{
                    if (parseInt(item.vote_id)===parseInt(this.vote.id) && item.ip=== this.ip) return item;
                }).filter(Boolean);
            }
            if (dd.length>0){
                this.q_answer = this.jsonDecode(dd[0].answer);
                this.is_vote = true;
            }else this.is_vote = false;
        },
        votePercentage(ans){
            let total = this.jsonDecode(this.answer).length;
            let cc= this.jsonDecode(this.answer).map((item)=>{
                if (item.answer===ans) return item;
            }).filter(Boolean).length;
            if (total <=0 || cc <=0) return 0;
            else return parseFloat( (cc*100)/ total).toFixed(0);
        }
    },
    watch:{
        answer(){
            this.isVote();
        }
    }
}
</script>
