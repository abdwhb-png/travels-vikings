<template>
    <main id="users">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">System Users ( {{ list.length }} )</h4>
                <div class="table-responsive">
                  <table class="table text-white">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Username </th>
                        <th> email </th>
                        <th> Created At </th>
                        <th> Updated At </th>
                        <th> Actions </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list" v-bind:key="index">
                        <td>{{ index }}</td>
                        <th>
                          <span class="ps-2">{{item.username}}</span>
                        </th>
                        <td> {{item.email}} </td>
                        <td> {{item.created_at}} </td>
                        <td> {{item.updated_at}} </td>
                        <td> <crud-buttons-component :urls="mystore.systemUsersCrudUrls(item['id'])" :delete="index == 0 ? false : true "></crud-buttons-component> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
import { computed } from 'vue'
import { useAdminStore } from "@/stores/AdminStore"
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
        }
      },
      methods: {
      },
     created: function () {
        this.mystore.getList('/admin/get/list/system-users')
      }
    }
</script>
