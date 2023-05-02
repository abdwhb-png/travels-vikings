<template>
    <main id="connection-logs">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">Connection Logs</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Username </th>
                        <th> IP Address </th>
                        <th> Country </th>
                        <th> City </th>
                        <th> Time </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list">
                        <td>{{item['id']}}</td>
                        <th>
                          <span class="ps-2">{{item['username']}}</span>
                        </th>
                        <td> {{item['ip_address']}} </td>
                        <td> {{item['country']}} </td>
                        <td> {{item['city']}} </td>
                        <td>
                          <div class="row">{{item['created_at']}}</div>
                          <div class="row">{{item['updated_at']}}</div>
                        </td>
                        <td>
                           <crud-buttons-component :urls="mystore.logsCrudUrls(item['id'])" :edit="false"></crud-buttons-component>
                        </td>
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
        this.mystore.getList('/admin/get/list/connection-logs')
      }
    }
</script>
