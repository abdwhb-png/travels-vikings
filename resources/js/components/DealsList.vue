<template>
    <main id="list">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                 <h4 class="card-title">Deals List ( {{ list.length }} )</h4>
                <div class="table-responsive">
                  <table class="table text-white">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Title </th>
                        <th> Description </th>
                        <th> Image </th>
                        <th> Actions </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in list" v-bind:key="index">
                        <td> {{item.id}} </td>
                        <td>
                          <span class="ps-2">{{item.title}}</span>
                        </td>
                        <td> {{item.description}} </td>
                        <td> <img :src="'/storage'+item.image_path" style="width:100px;height:100px" alt="image"> </td>
                        <td> <crud-buttons-component :urls="mystore.dealsCrudUrls(item.id)"  :duplicate="true" :deal="item"></crud-buttons-component> </td>
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
  import { computed, reactive } from 'vue'
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
        this.mystore.getList('/admin/get/list/deals')
      }
    }
</script>
