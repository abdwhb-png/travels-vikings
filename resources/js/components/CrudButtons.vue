<style scoped>
  a{
    margin-right: 8px;
    margin-bottom: 8px;
  }
  @media only screen and (max-width: 624px) {
    a{
      margin-bottom: 10px;
    }
  }
   .toggle {
      --width: 80px;
      --height: calc(var(--width) / 3);

      position: relative;
      display: inline-block;
      width: var(--width);
      height: var(--height);
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      border-radius: var(--height);
      cursor: pointer;
    }

    .toggle input {
      display: none;
    }

    .toggle .slider {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: var(--height);
      background-color: #ccc;
      transition: all 0.4s ease-in-out;
    }

    .toggle .slider::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: calc(var(--height));
      height: calc(var(--height));
      border-radius: calc(var(--height) / 2);
      background-color: #fff;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked+.slider {
      background-color: #2196F3;
    }

    .toggle input:checked+.slider::before {
      transform: translateX(calc(var(--width) - var(--height)));
    }

    .toggle .labels {
      position: absolute;
      top: 8px;
      left: 0;
      width: 100%;
      height: 100%;
      font-size: 12px;
      font-family: sans-serif;
      transition: all 0.4s ease-in-out;
    }

    .toggle .labels::after {
      content: attr(data-off);
      position: absolute;
      right: 5px;
      color: #4d4d4d;
      opacity: 1;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
      transition: all 0.4s ease-in-out;
    }

    .toggle .labels::before {
      content: attr(data-on);
      position: absolute;
      left: 5px;
      color: #ffffff;
      opacity: 0;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked~.labels::after {
      opacity: 0;
    }

    .toggle input:checked~.labels::before {
      opacity: 1;
    }
</style>
<template>
    <main id="list">
        <div v-if="action" class="row">
          <a href="#" v-if="showMore" class="btn btn-inverse-primary btn-sm col" data-bs-toggle="modal" :data-bs-target="'#showMoreModal'+member.id"> <i class="mdi mdi-eye"></i> Show All</a>
          <a v-if="edit && urls" :href="urls.edit" class="btn btn-primary btn-sm col"> <i class="mdi mdi-pencil"></i> Edit</a>
          <a v-if="changePwd" :href="urls.changePwd" class="btn btn-inverse-secondary btn-sm col"> <i class="mdi mdi-lock"></i> Password </a>
          <a v-if="delete" @click="deleteItem()" class="btn btn-danger btn-sm col"> <i class="mdi mdi-delete"></i> Delete</a>
          <a href="#" @click.prevent="duplicateDeal()" v-if="duplicate" class="btn btn-warning btn-sm col"> <i class="mdi mdi-content-copy"></i> Duplicate </a>
          <a :href="urls.showTask" v-if="showTask" class="btn btn-warning btn-sm col"> <i class="mdi mdi-eye"></i> Show Tasks </a>
          <a v-if="withdrawal" class="btn btn-dark btn-sm col" data-bs-toggle="modal" :data-bs-target="'#showWithdrawalModal'+member.id"> - Make Withdrawal </a>
        </div>
        <button v-else @click="action=true" type="button" class="btn btn-info">Actions</button>

        <div v-if="showMore" class="modal fade" :id="'showMoreModal'+member.id" tabindex="-1" aria-labelledby="showMoreModal" aria-hidden="true" data-tor-parent="show">
          <div class="modal-dialog modal-dialog-centered no-transform">
            <div class="modal-content bg-white" data-tor="show(p):reveal(up)">
              <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalPromoLabel5">{{member.username}}</h5>
                <code class="mx-2">Status:</code>
                <label class="toggle mx-2"><input type="checkbox" v-bind:checked="member['status']" @click="changeMemberStatus(member.user_id, member.status)"><span class="slider"></span><span class="labels" data-on="ON" data-off="OFF"></span></label>
                <button ref="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" v-if="member.status">
                <section v-for="(info, index) in member" v-bind:key="index">
                  <div v-if="!['user_id', 'status'].includes(index)" class="row border border-secondary my-1 py-2 rounded text-dark">
                    <div class="col text-capitalize text-center">{{index.replace('_', ' ')}}</div>
                    <div class="col">{{ info }}</div>
                  </div>
                </section>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-dark" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div v-if="withdrawal" class="modal fade" :id="'showWithdrawalModal'+member.id" tabindex="-1" aria-labelledby="showMoreModal" aria-hidden="true" data-tor-parent="show">
          <div class="modal-dialog modal-dialog-centered no-transform">
            <div class="modal-content bg-white" data-tor="show(p):reveal(up)">
              <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalPromoLabel5">{{member.username}}</h5>
                <code class="mx-2">Balance : </code> <span class="text-muted">{{ member.balance }}</span>
                <button ref="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               <input type="number" v-model="withdrawalAmount" class="form-control text-white mb-3" placeholder="Withdrawal Amount">
               <button type="button" class="btn btn-primary" @click="submitWithdrawal">Submit</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-dark" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
import { useAdminStore } from "@/stores/AdminStore";
import { computed, reactive } from "vue";
    export default {
      props: {
        action:{
          type: Boolean,
          default: true,
        },
        edit: {
          type: Boolean,
          default: true
        },
        showMore: {
          type: Boolean,
          default: false
        },
        member: {
          type: Object,
          required: false
        },
        urls: {
          type: Object,
          default: {}
        },
        changePwd: {
          type: Boolean,
          default: false
        },
        delete: {
          type: Boolean,
          default: true
        },
        duplicate: {
          type: Boolean,
          default: false
        },
        showTask: {
          type: Boolean,
          default: false
        },
        withdrawal: {
          type: Boolean,
          default: false
        },
        deal:{
          type: Object
        }
      },
      setup() {
        const mystore = useAdminStore();
        return {
            mystore,
        };
      },
      data() {
          return {
              response: computed(() => this.mystore.res),
              withdrawalAmount: '',
          };
      },
      methods: {
        async deleteItem(id) {
          if(confirm("Do you really want to DELETE ?")){
            await this.mystore.deleteItem(this.urls.delete, id)
            window.location.reload()
          }
        },
        changeMemberStatus(id, status){
          axios
            .put("/admin/change/member/status/" + id, {status: status})
            .then((response) => {
                if(response.data.status) {
                   this.$refs.closeModal.click()
                  this.mystore.getList('/admin/get/list/members')
                }
                else alert('Oops.. Something wrong. Please retry')
            })
            .catch((error) => console.log(error));
        },
         myFunc(item){
            if(item.id != this.deal.id) this.dealCategories.push(item)
        },
        duplicateDeal(event){
          if(confirm("Please click on OK to confirm DUPLICATION ?")){
            let form = reactive({
              title: this.deal.title,
              description: this.deal.description,
              image_path: this.deal.image_path,
            })
              axios
                  .put('/admin/duplicate/deal', form)
                  .then((response) => {
                    if(!response.data.status) alert(response.data.err)
                    window.location.reload()
                  })
                  .catch((error) => console.log(error));
          }
        },
        submitWithdrawal(){
          axios
                  .post(this.urls.withdrawal, {amount:this.withdrawalAmount})
                  .then((response) => {
                    console.log('Submiting withdrawal..')
                  })
                  .catch((error) => console.log(error));
                 window.location.reload();
        },
      },
      created: function () {
      }
    }
</script>
