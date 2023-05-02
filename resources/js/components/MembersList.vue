<style scoped>
  
</style>
<template>
    <main id="list">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">Members List ( {{ list.length }} )</h4>
                <div class="table-responsive">
                  <table class="table text-white">
                    <thead>
                      <tr>
                        <th> ID </th>
                        <th> Actions </th>
                        <th> Username </th>
                        <th> Parent ID </th>
                        <th> Email </th>
                        <th> Phone </th>
                        <th> Invitation Code </th>
                        <th> Balance </th>
                        <th> Completed Tasks </th>
                        <th> Total Commission </th>
                        <th> Created At </th>
                        <th> Updated At </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list" v-bind:key="index" :class="item['status'] ? '' : 'bg-danger text-white'" :id="'item-'+item.user_id">
                        <td>{{ item['id'] }}</td>
                        <td>
                           <crud-buttons-component :urls="mystore.membersCrudUrls(item['id'])" :action="false" :change-pwd="true" :show-more="true" :member="item" :show-task="true" :withdrawal="true"></crud-buttons-component>
                        </td>
                        <td>
                          <span class="ps-2">{{ item['username'] }}</span>
                        </td>
                        <td> <a :href="'#item-'+item['parent_id']">{{ item['parent_id'] ? item['parent_id'] : 'NONE'}}</a>  </td>
                        <td> {{ item['email'] }} </td>
                        <td> {{ item['phone'] }} </td>
                        <td> {{ item['invitation_code'] }} </td>
                        <td> {{ item['balance'] }} $</td>
                        <td> {{ item['completed_tasks'] }} </td>
                        <td> {{ item['total_commission'] }} $</td>
                        <td> {{ item['created_at'] }} </td>
                        <td> {{ item['updated_at'] }} </td>
                      </tr>
                    </tbody>
                  </table>
                  <Bootstrap5Pagination
                      :data="list"
                      @pagination-change-page="getResults"
                  />
                 <!-- <pagination-component :data="list" @pagination-change-page="this.mystore.getList('/admin/get/list/members')"></pagination-component> -->
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
import { computed, ref } from 'vue'
import { useAdminStore } from "@/stores/AdminStore"

import { Bootstrap5Pagination } from 'laravel-vue-pagination';
    export default {
      setup() {
        const mystore = useAdminStore()
        return {
          mystore
        }
      },
      data() {
        return {
          list:computed(() => this.mystore.list),
          members:ref({ok:{}, non:{}}),
          moreInfo:{},
          showMemberGrade: false,
        }
      },
      methods: {
        showMoreInfo(index){
          this.moreInfo = this.list[index]
        },
        async getResults (page = 1) {
            const response = await fetch(`https://example.com/results?page=${page}`);
            laravelData.value = await response.json();
        }
      },
     created: function () {
        this.mystore.getList('/admin/get/list/members')
      }
    }
</script>
