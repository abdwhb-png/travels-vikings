<template>
    <main id="roles">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">System Roles ( {{ list.length }} )</h4>
                <div class="table-responsive">
                  <table class="table text-white">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Role Title </th>
                        <th> Created At </th>
                        <!-- <th> Actions </th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list" v-bind:key="index">
                        <td>{{item.id}}</td>
                        <th>
                          <span class="ps-2">{{item.title}}</span>
                        </th>
                        <td>{{item.created_at}} </td>
                        <!-- <td> <crud-buttons-component :edit="false" :delete="false"></crud-buttons-component> </td> -->
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
        this.mystore.getList('/admin/get/list/system-roles')
      }
    }
</script>
